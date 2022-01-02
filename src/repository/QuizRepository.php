<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Quiz.php';
require_once __DIR__.'/../models/Question.php';

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

    public function getQuiz(string $id){
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
            $quiz['quiz_id'],
            $quiz['creator'],
            $quiz['time']
        );
    }

    public function getQuestions(string $quizId):Question{
        $stmt = $this->database->connect()->prepare(
            'SELECT * from questions q, answers a
            where q.question_id = a.question_od_fk and q.quiz_id_fk = :quizId'
        );

        $stmt->bindParam(':quizId', $quizId, PDO::PARAM_STR);
        $stmt->execute();

        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $qNumber = 0;
        $question = new Question(
            $questions[$qNumber]['quiz_id_fk'],
            $questions[$qNumber]['content'],
            $questions[$qNumber]['text'],
            $questions[$qNumber+1]['text'],
            $questions[$qNumber+2]['text'],
            $questions[$qNumber+3]['text']
        );
        return $question;
    }

    public function insertQuestion(Question $question){

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO questions (quiz_id_fk, content)
                   VALUES (?,?) returning question_id as id'
        );

        $stmt->execute([
            $question->getQuizId(),
            $question->getContent()
        ]);

        $id = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $this->database->connect()->prepare(
            'INSERT INTO answers (question_od_fk, text, is_correct)
                   VALUES (?,?,?)'
        );

        $stmt->execute([
            $id['id'],
            $question->getCorrect(),
            1
        ]);

        $this->insertAnswer($question->getIncorrect1(),$id['id']);
        $this->insertAnswer($question->getIncorrect2(),$id['id']);
        $this->insertAnswer($question->getIncorrect3(),$id['id']);

    }

    function insertAnswer(string $str, int $id){
        $stmt = $this->database->connect()->prepare(
            'INSERT INTO answers (question_od_fk, text, is_correct)
                   VALUES (?,?,?)'
        );

        $stmt->execute([
            $id,
            $str,
            0
        ]);
    }




}