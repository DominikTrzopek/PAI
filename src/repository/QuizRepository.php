<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';
require_once __DIR__.'/../models/Answer.php';
require_once __DIR__.'/../models/Score.php';

class QuizRepository extends Repository {


    public function insertQuiz(Quiz $quiz){

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO passwords (pass_hash)
                   VALUES (?) RETURNING pass_id as id'
        );

        $stmt->execute([
            $quiz->getPassword()
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO quizzes (name, description, time_restriction, creator_id, pass_id_fk, image, quiz_id, topic)
                   VALUES (?,?,?,?,?,?,?,?)
                   ON CONFLICT (quiz_id) DO UPDATE 
                   SET name = excluded.name,
                   description = excluded.description,
                   time_restriction = excluded.time_restriction,
                   pass_id_fk = excluded.pass_id_fk,
                   image = excluded.image,
                   topic = excluded.topic'
        );

        $stmt->execute([
            $quiz->getName(),
            $quiz->getDescription(),
            $quiz->getTime(),
            $quiz->getCreator(),
            $id['id'],
            $quiz->getImage(),
            $quiz->getId(),
            $quiz->getTopic()
        ]);

    }

    public function getQuizFromId(string $id){
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM quizzes WHERE quiz_id = :id'
        );
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();

        $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

        if($quiz == false){
            return null;
        }

        return new Quiz(
            $quiz['name'],
            $quiz['description'],
            $quiz['topic'],
            $quiz['image'],
            $quiz['time_restriction'],
            $quiz['quiz_id'],
            $quiz['creator_id']
        );
    }


    public function getQuizFromName(string $name){
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM quizzes WHERE name = :name'
        );
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $quiz = $stmt->fetch(PDO::FETCH_ASSOC);

        if($quiz == false){
            return null;
        }

        $quizData = new Quiz(
            $quiz['name'],
            $quiz['description'],
            $quiz['topic'],
            $quiz['image'],
            $quiz['time_restriction'],
            $quiz['quiz_id'],
            $quiz['creator_id']
        );

        return [$quizData,$quiz['pass_id_fk']];
    }

    public function getAllQuizzesFromName(string $searchString, string $userId){
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare(
            'SELECT DISTINCT q.* FROM quizzes q, quiz_rel r
                    WHERE ((q.creator_id = :id) OR (r.user_id_fk = :id AND r.quiz_id_fk = q.quiz_id)) AND LOWER(q.name) LIKE :search'
        );
        $stmt->bindParam(':id',$userId, PDO::PARAM_STR);
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function getQuizPassword($id){
        $stmt = $this->database->connect()->prepare(
            'SELECT * FROM passwords WHERE pass_id = :pass_id'
        );
        $stmt->bindParam(':pass_id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $pass = $stmt->fetch(PDO::FETCH_ASSOC);

        return $pass['pass_hash'];

    }


    public function getQuizzes(string $userId): array{
        $result = [];
        $stmt = $this->database->connect()->prepare(
            'SELECT DISTINCT q.* FROM quizzes q, quiz_rel r
                    WHERE (q.creator_id = :id) OR (r.user_id_fk = :id AND r.quiz_id_fk = q.quiz_id)'
        );

        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);


        $stmt->execute();
        $quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($quizzes as $quiz){
            $result [] = new Quiz(
                $quiz['name'],
                $quiz['description'],
                $quiz['topic'],
                $quiz['image'],
                $quiz['time'],
                $quiz['quiz_id'],
                $quiz['creator_id']
            );
        }
        return $result;
    }



    public function getQuestions(string $quizId): array{
        $stmt = $this->database->connect()->prepare(
            'SELECT * from questions q
            where q.quiz_id_fk = :quizId'
        );

        $stmt->bindParam(':quizId', $quizId, PDO::PARAM_STR);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($questions as $question){
            $result[] = new Question(
                $question['quiz_id_fk'],
                $question['content'],
                $question['question_id']
            );
        }

        return $result;
    }

    public function getAnswers(string $questionId): array{
        $stmt = $this->database->connect()->prepare(
            'SELECT * from answers a
            where a.question_od_fk = :questionId'
        );

        $stmt->bindParam(':questionId', $questionId, PDO::PARAM_STR);
        $stmt->execute();

        $result = [];

        $answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($answers as $answer){
            $result[] = new Answer(
                $answer['text'],
                $answer['is_correct'],
                $answer['question_od_fk'],
                $answer['answer_id']
            );
        }

        return $result;
    }

    public function getAnswerFromId(int $id): Answer{
        $stmt = $this->database->connect()->prepare(
            'SELECT * from answers a
            where a.answer_id = :id'
        );

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $answer = $stmt->fetch(PDO::FETCH_ASSOC);

        return new Answer(
            $answer['text'],
            $answer['is_correct'],
            $answer['question_od_fk'],
            $answer['answer_id']
        );
    }


    public function insertQuestion(string $quizId, $content ){

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO questions (quiz_id_fk, content)
                   VALUES (?,?) returning question_id as id'
        );

        $stmt->execute([
            $quizId,
            $content
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        return $id['id'];

    }

   public function insertAnswer(string $str, int $id, string $flag){
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO answers (question_od_fk, text, is_correct)
                   VALUES (?,?,?)'
        );

        $stmt->execute([
            $id,
            $str,
            $flag
        ]);
    }

    public function insertScore(string $quizId, string $userId, string $score){
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO scores (quiz_id_fk, user_id_fk, score, date)
                   VALUES (?,?,?,?)'
        );

        $date = new DateTime();

        $stmt->execute([
            $quizId,
            $userId,
            $score,
            $date->format('Y-m-d')
        ]);
    }

    public function joinQuiz(string $userId, string $quizId){
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO quiz_rel (quiz_id_fk, user_id_fk)
                   VALUES (?,?)'
        );
        $stmt->execute([
            $quizId,
            $userId
        ]);

    }

    public function getScores(string $userId){
        $stmt = $this->database->connect()->prepare(
            'SELECT s.score_id, s.score as score, s.date as date, q.name as name, (Select count(q2.name) FROM questions qu, quizzes q2
            WHERE qu.quiz_id_fk = q2.quiz_id AND q2.name = q.name) AS max FROM scores s, quizzes q
            WHERE s.user_id_fk = :id AND s.quiz_id_fk = q.quiz_id'
        );

        $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
        $stmt->execute();

        $scores = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($scores as $score){
            $result[] = new Score(
                $score['score'],
                $score['date'],
                $score['name'],
                $score['max']
            );
        }

        return $result;

    }


}