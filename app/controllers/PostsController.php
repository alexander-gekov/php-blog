<?php

class PostsController extends Controller
{

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];
        $this->view('posts/index', $data);
    }

    public function create()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


            $file = $_FILES['image'];
            $fileName = $file['name'];
            $fileType = $file['type'];
            $fileTempName = $file['tmp_name'];
            $fileError = $file['error'];
            $fileSize = $file['size'];
            $imageFullName = '';

            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

            $allowed = array('jpg', 'jpeg', 'png');

            if (in_array($fileActualExt, $allowed)) {
                if ($fileError === 0) {
                    if ($fileSize < 20000000) {
                        $imageFullName = uniqid('', false) . '.' . $fileActualExt;
                        $fileDestination = $_SERVER['DOCUMENT_ROOT'] . '/public/img/' . $imageFullName;
                        move_uploaded_file($fileTempName, $fileDestination);
                    }
                }

            }

            $data = [
                'title' => trim($_POST['title']),
                'text' => trim($_POST['text']),
                'user_id' => $_SESSION['user_id'],
                'imgPath' => $fileDestination,
                'title_err' => '',
                'text_err' => ''
            ];


            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title.';
            }

            if (strlen($data['title']) > 70) {
                $data['title_err'] = 'Title is too long.';
            }

            if (empty($data['text'])) {
                $data['text_err'] = 'Please enter text.';
            }

            if (empty($data['title_err']) && empty($data['text_err'])) {
                $data['imgPath'] = $imageFullName;

                if ($this->postModel->createPost($data)) {

                    flash('post_added', 'Post Added!');
                    redirect('posts');

                } else {
                    die('Something went wrong');
                }

            } else {
                $this->view('posts/create', $data);
            }

        } else {

            $data = [
                'title' => '',
                'text' => '',
                'imgPath' => '',
                'title_err' => '',
                'text_err' => ''
            ];

            $this->view('posts/create', $data);
        }
    }

    public function show($id)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user,
        ];

        $this->view('posts/show', $data);
    }
}