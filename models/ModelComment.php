<?php
namespace Forteroche\Models;

require_once("models/Model.php");

/**
 * Manipulation des données concernant les commentaires
 */
class ModelComment extends Model
{
    private $_db;

    public function __construct()
    {
        $this->_db = parent::dbConnect();
    }

    // GETTERS

    // Récupération des commentaires d'un chapitre
    public function getComments($postId)
    {
        $commentsData = $this->_db->prepare('SELECT comment_id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reporting FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $commentsData->execute(array($postId));

        return $commentsData;
    }

    // Récupération des 5 derniers commentaires non signalés
    public function getLastComments()
    {
        $lastCommentsData = $this->_db->query('SELECT comment_id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE reporting=0 ORDER BY comment_date DESC LIMIT 0, 5');

        return $lastCommentsData;
    }

    // Récupération des commentaires signalés
    public function getReportedComments()
    {
        $reportedCommentsData = $this->_db->query('SELECT comment_id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr, reporting FROM comments WHERE reporting=1 ORDER BY comment_date DESC');

        return $reportedCommentsData;
    }

    // SETTERS

    // Ajout d'un commentaire
    public function setComment($postId, $author, $comment)
    {
        $query = $this->_db->prepare('INSERT INTO comments(post_id, author, comment, comment_date, reporting) VALUES(?, ?, ?, NOW(), 0)');
        $executedQuery = $query->execute(array($postId, $author, $comment));

        return $executedQuery;
    }

    // Modification d'un commentaire
    public function editComment($author, $comment, $commentId)
    {
        $query = $this->_db->prepare('UPDATE comments SET author = ?, comment = ?, reporting = ? WHERE comment_id = ?');
        date_default_timezone_set('Europe/Paris');
        $commentWithEditDate = $comment . "\n\n" . '[Edité par le modérateur le ' . date('d/m/Y à H\hi\m\i\ns\s]');
        $executedQuery = $query->execute(array($author, $commentWithEditDate, 0, $commentId));

        return $executedQuery;
    }

    // Suppression d'un commentaire
    public function removeComment($commentId)
    {
        $query = $this->_db->prepare('DELETE FROM comments WHERE comment_id = ?');
        $executedQuery = $query->execute(array($commentId));

        return $executedQuery;
    }

    // Suppression des commentaires d'un chapitre
    public function removeComments($postId)
    {
        $query = $this->_db->prepare('DELETE FROM comments WHERE post_id = ?');
        $executedQuery = $query->execute(array($postId));

        return $executedReq;
    }

    // Signalement d'un commentaire
    public function reportComment($commentId)
    {
        $query = $this->_db->prepare('UPDATE comments SET reporting = ? WHERE comment_id = ?');
        $executedQuery = $query->execute(array(1, $commentId));

        return $executedQuery;
    }
}