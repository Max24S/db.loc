<?php
	ini_set("display_errors", 1);
	error_reporting(E_ALL);
    require_once('request.class.php');
$requestClass = new Request();

        if( $requestClass->isPost() ){

                if ($_POST['action'] == 'add') {
                    require_once('models/users.class.php');
                    $User = new Users();
                    $requestClass->required('title');
                    $requestClass->required('annotation');
                    $requestClass->required('content');
                    $requestClass->min('title', 5);
                    $requestClass->min('annotation', 5);
                    $requestClass->min('content', 5);
                    $requestClass->max('title', 10);
                    $requestClass->max('annotation', 10);
                    $requestClass->max('content', 10);
                    $errors = $requestClass->getErrors();
                    if (count($errors)>0) {
                        echo json_encode($errors);
                    }
                    else {
                        $result = $User->insert(['name' => trim($_POST['title']), 'date_published' => trim($_POST['date']), 'status' => trim($_POST['publish_in_index']), 'category' => trim($_POST['category']), 'text' => trim($_POST['content']), 'author' => trim($_POST['annotation'])]);
                        $status = 'error';
                        if ($result) {
                            $status = 'ok';
                        }
                        echo json_encode(['status' => $status]);
                    }
                }
                if($_POST['action'] == 'edit')
                {
                      require_once('models/users.class.php');
                      $cityClass = new Users();
//                      $isDublicate=$cityClass->idDublicate($_POST['id'],trim($_POST['title']));
                    $result = $cityClass->update(['id'=>trim($_POST['id']),'name'=>trim($_POST['city'])]);
                      $status = 'error';
                        if ($result) {
                            $status = 'ok';
                        }
                      echo json_encode(['status' =>$status]);
                }

        }
//        if ($_POST['action'] == 'add') {
//
//            require_once('models/users.class.php');
//
//            $User = new Users();
//
//            // $result = $cityClass->insert(['name'=>trim($_POST['city'])]);
////            $count = $cityClass->get_count(['name' => trim($_POST['city'])]);
//
//
////            $message = "";
////            if ($count > 0) {
////
////                $message = "Этот город есть уже в базе";
////            } else {
////                $result = $cityClass->insert(['name' => trim($_POST['city'])]);
////                $status = 'ok';
////            }
//            $result = $cityClass->insert(['name'=>trim($_POST['title']),'date_published'=>trim($_POST['date']),'status'=>trim($_POST['publish_in_index']),'category'=>trim($_POST['category']),'text'=>trim($_POST['content']),'author'=>trim($_POST['annotation'])]);
//
//            $status = 'error';
//            if($result)
//            {
//                $status = 'ok';
//            }
//            echo json_encode(['status' => $status]);
//    }
//
//		if($_POST['action'] == 'edit')
//		{
//
//			require_once('models/city.class.php');
//
//			$cityClass = new City();
//
//
//			$isDublicate=$cityClass->idDublicate($_POST['id'],trim($_POST['city']));
//
//			$status = 'error';
//			$message="";
//
//			if(!$isDublicate)
//			{
//				$result = $cityClass->update(['id'=>trim($_POST['id']),'name'=>trim($_POST['city'])]);
//				$status="ok";
//			}
//			else {
//				$message="есть уже дубликат";
//			}
//
//			echo json_encode(['status' =>$status,'message'=>$message]);
//		}
//	}

