<?php
session_start();
require('controllers/controllerFrontend.php');
require('controllers/controllerBackend.php');

try {
    
    if (isset($_GET['action'])) {
        
        /* Front End Router */

        if ($_GET['action'] == 'seeHome') {
            seeHome();

        } elseif ($_GET['action'] == 'seeListPosts') {
            seeListPosts();
        
        } elseif ($_GET['action'] == 'seePost') {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                seePost($_GET['postId']);
            } else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }

        } elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['postId'], $_POST['author'], $_POST['comment']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucun identifiant de chapitre envoyé');
            }

        } elseif ($_GET['action'] == 'reportComment') {
            if (isset($_GET['commentId']) && $_GET['commentId'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    reportComment($_GET['commentId'], $_GET['postId']);
            } else {
                throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
            }

        } elseif ($_GET['action'] == 'seeAuthor') {
            seeAuthor();

        } elseif ($_GET['action'] == 'seeSignIn') {
            seeSignIn();

        } elseif ($_GET['action'] == 'signIn') {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                signIn($_POST['username'], $_POST['password']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }

        /* Debugging *********************************
        } elseif ($_GET['action'] == 'addUser') {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                addUser($_POST['username'], $_POST['password']);
            } else {
                throw new Exception('Tous les champs ne sont pas remplis !');
            }*/
     
        /* Back End Router */

        } elseif ($_GET['action'] == 'seeDashboard') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                seeDashboard();
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'seeAddPost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                seeAddPost();
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'addPost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (!empty($_POST['title']) && !empty($_POST['content'])) {
                    addPost($_POST['title'], $_POST['content']);
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }  

        } elseif ($_GET['action'] == 'seeEditPosts') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                seeEditPosts();
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'seeEditPost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    seeEditPost($_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }
        
        } elseif ($_GET['action'] == 'editPost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    if (!empty($_POST['title']) && !empty($_POST['content'])) {
                        editPost($_GET['postId'], $_POST['title'], $_POST['content']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'seeRemovePost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    seeRemovePost($_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'removePost') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (isset($_GET['postId']) && $_GET['postId'] > 0) {
                    removePost($_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'editComment') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {            
                if (isset($_GET['commentId']) && $_GET['commentId'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                        editComment($_GET['postId'], $_POST['author'], $_POST['comment'], $_GET['commentId']);
                    } else {
                        throw new Exception('Tous les champs ne sont pas remplis !');
                    }
                } else {
                    throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'removeComment') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (isset($_GET['commentId']) && $_GET['commentId'] > 0 && isset($_GET['postId']) && $_GET['postId'] > 0) {
                    removeComment($_GET['commentId'], $_GET['postId']);
                } else {
                    throw new Exception('Aucun identifiant de chapitre ou de commentaire envoyé');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'seeSettings') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                seeSettings();
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'editUsername') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (!empty($_POST['newUsernameOne']) && !empty($_POST['newUsernameTwo'])) {
                    if ($_POST['newUsernameOne'] == $_POST['newUsernameTwo']) {
                        editUsername($_POST['newUsernameOne']);
                    } else {
                        throw new Exception('L\'identifiant doit être écrit deux fois à l\'identique');
                    }
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }
        
        } elseif ($_GET['action'] == 'editPassword') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                if (!empty($_POST['newPasswordOne']) && !empty($_POST['newPasswordTwo'])) {
                    if ($_POST['newPasswordOne'] == $_POST['newPasswordTwo']) {
                        editPassword($_POST['newPasswordOne']);
                    } else {
                        throw new Exception('Le mot de passe doit être écrit deux fois à l\'identique');
                    }
                } else {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } elseif ($_GET['action'] == 'signOut') {
            if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
                signOut();
            } else {
                throw new Exception('Aucune connexion en tant qu\'administrateur');
            }

        } else {
            throw new Exception('Aucune action définie');
        }

    } else {
        seeHome();
    }
    
} catch(Exception $e) {
    $errorMessage = $e->getMessage();
    require('views/viewError.php');
}