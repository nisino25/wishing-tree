<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


use App\Models\Avatars;
use App\Models\Users;
use App\Models\Trees;
use App\Models\Wishes;

use Illuminate\Http\Request;

use DB;
use Illuminate\Database\QueryException;


class GeneralController extends Controller{
    
    public function index(){
			$totalWishes = Wishes::count();
			$totalUsers = Users::count();
			$totalTrees = Trees::count();
				// echo 'test';
        // $contacts = Contacts::all();
        // return view('contacts.index', compact('contacts'));
        // $params = [
        //     'test' => 'this is test',
        //     'sample' => 'this is sample'
        // ];

        // return view('index', compact('params'));
				return view('index', compact('totalWishes','totalUsers','totalTrees',));
    }

		public function activity(){
			$totalTrees = Trees::count();
			$totalTrees--;

			return view('activity',compact('totalTrees'));
		}

		public function login(){
			$links = Avatars::all();
			// $links = 'hey';
      return view('login', compact('links'));
		}

		public function loginConfirm(){
			$links = Avatars::all();

			
			$username = $_COOKIE["username"];
			if(Users::where('username', '=', $_COOKIE["username"])->count() > 0) {
				$hashed_password = DB::table('users')->where('username', $username)->value('hashed_password'); 
				if(password_verify($_COOKIE['password'], $hashed_password)) {
					unset($_COOKIE["warning"]);
					setcookie('warning', null, -1, '/'); 
					unset($_COOKIE["password"]);
					setcookie('password', null, -1, '/'); 
					
					$id = DB::table('users')->where('username', $username)->value('id'); 
					$picnum = DB::table('users')->where('username', $username)->value('avatar_id');

					setcookie('id', $id, time() + (86400 * 30), "/");
					setcookie('username', $username, time() + (86400 * 30), "/");
					setcookie('picnum', $picnum, time() + (86400 * 30), "/");
					setcookie('is_logined', 0, time() + (86400 * 30), "/");

					header("Location: ./");
        	die();

				}else{
					setcookie('warning', 'ユーザーネームかパスワードが違います', time() + (86400 * 30), "/");
					header("Location: ./login");
        	die();
				}
			}else{
				setcookie('warning', 'ユーザーネームかパスワードが違います', time() + (86400 * 30), "/");
				header("Location: ./login");
        die();
			};



				unset($_COOKIE["username"]);
				setcookie('username', null, -1, '/'); 

				unset($_COOKIE["password"]);
				setcookie('password', null, -1, '/'); 

				unset($_COOKIE["first_secret"]);
				setcookie('first_secret', null, -1, '/'); 

				unset($_COOKIE["second_secret"]);
				setcookie('second_secret', null, -1, '/'); 

				unset($_COOKIE["picnum"]);
				setcookie('picnum', null, -1, '/'); 

				unset($_COOKIE["validation"]);
				setcookie('validation', null, -1, '/'); 

				

				
			
			return view('loginConfirm', compact('links'));
		}

		public function logout(){
			setcookie('username', null, -1, '/'); 
			unset($_COOKIE["username"]);

			setcookie('picnum', null, -1, '/'); 
			unset($_COOKIE["picnum"]);
			
			setcookie('is_logined', null, -1, '/'); 
			unset($_COOKIE["is_logined"]);

			header("Location: ./");
			die();
		}

		public function signup(){
			$links = Avatars::all();

			unset($_COOKIE["warning"]);
			setcookie('warning', null, -1, '/'); 
			
			// $links = 'hey';
      return view('signup', compact('links'));
			
		}

		public function createUser(){
			if($_COOKIE['validation'] == 1){
				header("Location: ./signup");
        die();
			}else{
				$hashedPassword = password_hash($_COOKIE["password"],PASSWORD_DEFAULT);
				$hashedFirstSecret = password_hash($_COOKIE["first_secret"],PASSWORD_DEFAULT);
				$hashedSecondSecret = password_hash($_COOKIE["second_secret"],PASSWORD_DEFAULT);

				if (Users::where('username', '=', $_COOKIE["username"])->count() > 0) {
					// user exists
					header('Location: ./signup?warning=このユーザーネームは既に使用されています');
        	die();
			 	}else{
					\App\Models\Users::insert([
						'username' => $_COOKIE["username"],
						'hashed_password' => $hashedPassword,
						'created_at' => now(),
						'avatar_id' => $_COOKIE["picnum"],
						'first_secret' => $hashedFirstSecret,
						'second_secret' => $hashedSecondSecret
					]);

					setcookie('username', $_COOKIE["username"], time() + (86400 * 30), "/");
					setcookie('picnum', $_COOKIE["picnum"], time() + (86400 * 30), "/");
					setcookie('is_logined', 0, time() + (86400 * 30), "/");

					unset($_COOKIE["password"]);
					setcookie('password', null, -1, '/'); 

					unset($_COOKIE["first_secret"]);
					setcookie('first_secret', null, -1, '/'); 

					unset($_COOKIE["second_secret"]);
					setcookie('second_secret', null, -1, '/'); 

					unset($_COOKIE["validation"]);
					setcookie('validation', null, -1, '/'); 

					unset($_COOKIE["warning"]);
					setcookie('warning', null, -1, '/'); 

					

					header("Location: ./");
					die();
				}
			



				
			};
		}

		public function reset(){
			return view('reset');
		}

		public function requestReset(){
			if(isset($_GET['username'])){
				if (Users::where('username', '=', $_GET['username'])->count() > 0) {
					header('Location: ./resetForm?username=' . $_GET['username']);
        	die();
				}else{
					header('Location: ./reset?warning=このユーザーネームは存在しません');
        	die();
				}
				
			}
			
		}

		public function resetForm(){
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./index");
				exit;
			}
			return view('resetForm');
		}

		public function resetConfirm(){
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./index");
				exit;
			}

			if(isset($_GET['username'])){
				$username = $_GET['username'];
				if (Users::where('username', '=', $_GET['username'])->count() > 0) {
					$hashed_first = DB::table('users')->where('username', $username)->value('first_secret'); 
					$hashed_second = DB::table('users')->where('username', $username)->value('second_secret'); 

					if(password_verify($_GET['first_secret'], $hashed_first)) {
					
						if(password_verify($_GET['second_secret'], $hashed_second)) {
							header('Location: ./passwordForm?username=' .$username);
        			die();
						}else{
							
						}
					}else{
						header('Location: ./resetForm?warning=シークレットが間違っています&username=' .$username);
        		die();
					}
				
				};
			}

		}

		public function passwordForm(){
			return view('passwordForm');
		}

		public function updatePassword(){
			$username = $_GET['username'];
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./index");
				exit;
			}

			if($_GET['first_password'] == $_GET['second_password']){
				$old_hashed = DB::table('users')->where('username', $username)->value('hashed_password');
				$new_password = $_GET['first_password'];
				$new_hashed = password_hash($new_password,PASSWORD_DEFAULT);
				
				if(password_verify($new_password, $old_hashed)){
					header('Location: ./passwordForm?warning=前と同じパスワードは使えません&username=' .$username);
        	die();
				}else{
					\App\Models\Users::where('username', $username)->update(['hashed_password' => $new_hashed, 'updated_at' => now()]);
					header('Location: ./login');
        	die();
				}

			}else{
				header('Location: ./passwordForm?warning=入力した二つのパスワードが一致しません&username=' .$username);
        die();
			}
			
			// return view('passwordForm');
		}

		public function trees(){
			$wishes = Wishes::all();
			$trees = Trees::all();
			// $username = $_COOKIE["username"];
			// $id = DB::table('users')->where('username', $username)->value('id');

			return view('trees',compact('trees',));
		}

		public function treeDetail(){
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./trees");
				exit;
			}
			$treeId= $_GET['treeId'];
			$treeWishes = DB::table('trees')->where('id', $treeId)->value('wishes');
			$time = DB::table('trees')->where('id', $treeId)->value('created_at');
			$treeWishes = json_decode($treeWishes,true); 
			$treeId = (int)$treeId;

			$wishes = Wishes::all();
			$trees = Trees::all();

			return view('treeDetail', compact('treeId','wishes','trees','treeWishes','time'));
		}

		public function mypage(){
			$wishes = Wishes::all();
			$username = $_COOKIE["username"];
			$picnum = $_COOKIE["picnum"];
			$picLink = DB::table('avatars')->where('id', $picnum)->value('link');
			$id = DB::table('users')->where('username', $username)->value('id');

			return view('mypage',compact('username','picLink','wishes','id'));
		}

		public function remove(){
			echo now();
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./trees");
				exit;
			}
			$wishId = $_GET['id'];
			\App\Models\Wishes::where('id', $wishId)->update(['is_deleted' => 0]);
			header("Location: ./mypage");
      die(); 
		}

    public function contact(){
      $results = Contacts::all();
      return view('contacts.contact', compact('results'));
      if(isset($_POST['submit'])){
        $username = $_POST['name']; 
      }    
			$validationFlag = true;
			$validationList = [
					"name"=> true,
					"kana"=> true,
					"tel"=> true,
					"email"=> true,
					"body"=> true,
			];
			$_SESSION['validationList'] = $validationList;
			$_SESSION['validationFlag'] = $validationFlag;
      echo $username;
      return view('contacts.check');
        // $params = [
        //     'test' => 'this is test',
        //     'sample' => 'this is sample'
        // ];

        // return view('contacts.index', compact('params'));
    }

		public function wishForm(){
			return view('wishForm');
		}

		public function submitWish(){
			$wish = $_COOKIE['wish'];
			$privacy = (int)$_COOKIE['privacy'];

			$username = $_COOKIE['username'];
			$id = DB::table('users')->where('username', $username)->value('id');

			$latestTree= \App\Models\Trees::all()->last();
			$treeId = $latestTree->id;
			
			\App\Models\Wishes::insert([
				'user_id' => $id,
				'is_private' => $privacy,
				'created_at' => now(),
				'updated_at' => now(),
				'content' => $wish,
				'tree_id' => $treeId
			]);


			
			$latestWish= \App\Models\Wishes::all()->last();
			$wishId = $latestWish->id;

			$latestTree= \App\Models\Trees::all()->last();
			$treeWishes = $latestTree->wishes;

			$treeWishes = json_decode($treeWishes, true);

			if(sizeof($treeWishes) >= 10){
				\App\Models\Trees::where('id', $treeId)->update(['isFull' => 0]);

				\App\Models\Trees::insert([
					'created_at' => now(),
					'updated_at' => now(),
					'wishes' => '['. $wishId .']',
					'count' => 1,
					'isFull' => 1
				]);

			}else{

				array_push($treeWishes, $wishId);
				$treeCount = count($treeWishes);
				$treeWishes = json_encode($treeWishes, true);
				
				\App\Models\Trees::where('id', $treeId)->update(['wishes' => $treeWishes, 'updated_at' => now(), 'count' => $treeCount ]);
			}
			



			// ------------------------------------------------------------

			

			
			$usersWishes = DB::table('users')->where('username', $username)->value('wishes');
			
			if(!$usersWishes){
				$usersWishes = [$wishId];
				$usersWishes = json_encode($usersWishes, true);

			}else{
				$usersWishes = json_decode($usersWishes, true);
				array_push($usersWishes, $wishId);
				$usersWishes = json_encode($usersWishes, true);
			}
			
			
			\App\Models\Users::where('username', $username)->update(['wishes' => $usersWishes, 'updated_at' => now() ]);

			// $usersWish = DB::table('users')->where('username', $username)->value('wishes');

			// if(!$usersWish){
			// 	// create then add it
			// }

			// \App\Models\Users::where('username', $username)->update(['wishes' => $array, 'updated_at' => time() ]);


			header("Location: ./mypage");
      die();



		}

		public function practice(){
			$wishes = Wishes::all();
			$trees = Trees::all();
			$username = $_COOKIE["username"];
			$id = DB::table('users')->where('username', $username)->value('id');

			return view('practice',compact('username','trees','id'));
		}








    public function display(){
        echo $_POST['name']; 
    }

    public function check(Request $request) {
			$results = Contacts::all();
      // return view('contacts.contact', compact('results'));

			// 投稿内容の受け取って変数に入れる
			$name = $request->input('name');
			$kana = $request->input('kana');
			$tel = $request->input('tel');
			$email = $request->input('email');
			$body = $request->input('body');

			
			$nameError= '';
			$kanaError = '';
			$telError = '';
			$emailError = '';
			$bodyError = '';

			$validationFlag = true;
			if(!$name){
        $nameError = '氏名は必須入力です。　１０文字以内でご入力ださい。';
				echo '1';
        $validationFlag = false;
      };
      
      if(mb_strlen(strval($name)) > 10){
				echo '2';
        $nameError = '氏名は１０文字以内でご入力ださい。' . mb_strlen($name);
        $validationFlag = false;
      };
      
      
      // kana validation
      if(!$kana){
				echo '3';
      $kanaError = 'フリガナは必須入力です。　１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };
      
      if(mb_strlen($kana) > 10){
				echo '4';
      $kanaError = 'フリガナは１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };

      if($tel){
				
          $str = $tel;
          for($i =0; $i<strlen($tel); $i++){
              if($str[0] == '0' || $str[0] == '1' || $str[0] == '2'|| $str[0] == '3'|| $str[0] == '4'|| $str[0] == '5'|| $str[0] == '6'|| $str[0] == '7'|| $str[0] == '8' || $str[0] == '9'){
              } else{
								echo '5';
                  $telError = '電話番号は0-9の数字のみでご入力ください';
                  $validationFlag = false;
              };
              $str = substr($str, 1);
          };
      }else{
				$tel = '';
			}

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '6';
          $emailError = 'メールアドレスは正しくご入力ください。';
          $validationFlag = false;
      };

      if(strlen($body) == ''){
				echo '7';
          $bodyError ='お問い合わせ内容は必須入力です。';
          $validationFlag = false;
      }

			// echo '8';

			// 変数をビューに渡す
			$body  =str_replace("\n", '<br />', $body);

			

			if($validationFlag){
				// $_SESSION['name'] = $name;
				// $_SESSION['kana'] =$kana;
				// $_SESSION['tel'] =$tel;
				// $_SESSION['email']  =$email;
				// $_SESSION['body'] =$body;

				\App\Models\Contacts::insert([
					'name' => $name,
					'kana' => $kana,
					'tel' => $tel,
					'email' => $email,
					'body' => $body,
					'created_at' => now()
				]);
				// header("Location: ./index");
				// die();

				// session('name') = $name;
				// session('kana') =$kana;
				// session('tel') =$tel;
				// session('email')  =$email;
				// session('body') =$body;
				
				// echo 'syo';
				return view('contacts.complete')->with([
					"name" => $name,
					"kana"  => $kana,
					"tel"  => $tel,
					"email"  => $email,
					"body"  => $body,
				]);
			}else{
				// echo 'syoaaa';
				return view('contacts.contact')->with([
					"name" => $name,
					"kana"  => $kana,
					"tel"  => $tel,
					"email"  => $email,
					"body"  => $body,
					"validationFlag" => $validationFlag,
					'results' => $results,

					'nameError' => $nameError,
					'kanaError' => $kanaError,
					'telError' => $telError,
					'emailError' => $emailError,
					'bodyError' => $bodyError
			]);
			}
			
		}

		public function create(Request $request){
			$name = $request->input('name');
			$kana = $request->get('kana');
			$tel = $request->get('tel');
			$email = $request->get('email');
			$body =  $request->get('body');

			\App\Models\Contacts::insert([
				'name' => $name,
				'kana' => $kana,
				'tel' => $tel,
				'email' => $email,
				'body' => $body,
				'created_at' => now()
			]);


			// $GLOBALS['connection'] = mysqli_connect('localhost', 'root', '', 'cafe');
			// $name = mysqli_real_escape_string($GLOBALS['connection'],$name );
      // $kana = mysqli_real_escape_string($GLOBALS['connection'],$kana );
      // $tel = mysqli_real_escape_string($GLOBALS['connection'],$tel );
      // $email = mysqli_real_escape_string($GLOBALS['connection'],$email );
      // $body = mysqli_real_escape_string($GLOBALS['connection'],$body );
			// $results = DB::insert("INSERT INTO contacts(name,kana,tel,email,body,created_at) VALUES ('$name', '$kana', '$tel', '$email', '$body',now() )");
  
      // $query = "INSERT INTO contacts(name,kana,tel,email,body,created_at)";
      // $query .= "VALUES ('$name', '$kana', '$tel', '$email', '$body',now() )";
  
      // $result = mysqli_query($GLOBALS['connection'], $query); 
			header("Location: ./index");
      die();
		}

		public function delete(Request $request){
				if(!isset($_SERVER['HTTP_REFERER'])){
					header("Location: ./index");
					exit;
				}

				$id = $_GET['id'];
				$deleted = DB::delete('delete from contacts where id = '. $id);

				if(!$deleted){
					// echo gettype($id);
					die('failed sending data' . $id);
				}else{
					header("Location: ./index");
					die();
				}
		}

		public function edit(Request $request){
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./index");
				exit;
			}

			$id = $_GET['id'];
			// $edited = DB::edit('delete from contacts where id = '. $id);
			// $user = DB::select('select name from contacts where id = ' . $id , [1]);
			$name = DB::table('contacts')->where('id', $id)->value('name'); 
			$kana = DB::table('contacts')->where('id', $id)->value('kana'); 
			$tel = DB::table('contacts')->where('id', $id)->value('tel');
			$email = DB::table('contacts')->where('id', $id)->value('email'); 
			$body = DB::table('contacts')->where('id', $id)->value('body'); 
			// print_r($user);
			// $user = DB::find($id);
			// $user = 'sup';

			return view('contacts.edit', compact('name','id','kana','email','body','tel'));

		}

		public function editCheck(Request $request){
			if(!isset($_SERVER['HTTP_REFERER'])){
				header("Location: ./index");
				exit;
			}

			$id = $_GET['id'];

			// $results = Contacts::all();
      // return view('contacts.contact', compact('results'));

			// 投稿内容の受け取って変数に入れる
			$name = $request->input('name');
			$kana = $request->input('kana');
			$tel = $request->input('tel');
			$email = $request->input('email');
			$body = $request->input('body');

			
			$nameError= '';
			$kanaError = '';
			$telError = '';
			$emailError = '';
			$bodyError = '';

			$validationFlag = true;
			if(!$name){
        $nameError = '氏名は必須入力です。　１０文字以内でご入力ださい。';
				echo '1';
        $validationFlag = false;
      };
      
      if(mb_strlen(strval($name)) > 10){
				echo '2';
        $nameError = '氏名は１０文字以内でご入力ださい。' . mb_strlen($name);
        $validationFlag = false;
      };
      
      
      // kana validation
      if(!$kana){
				echo '3';
      $kanaError = 'フリガナは必須入力です。　１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };
      
      if(mb_strlen($kana) > 10){
				echo '4';
      $kanaError = 'フリガナは１０文字以内でご入力ださい。';
      $validationFlag  = false;
      };

      if($tel){
				
          $str = $tel;
          for($i =0; $i<strlen($tel); $i++){
              if($str[0] == '0' || $str[0] == '1' || $str[0] == '2'|| $str[0] == '3'|| $str[0] == '4'|| $str[0] == '5'|| $str[0] == '6'|| $str[0] == '7'|| $str[0] == '8' || $str[0] == '9'){
              } else{
								echo '5';
                  $telError = '電話番号は0-9の数字のみでご入力ください';
                  $validationFlag = false;
              };
              $str = substr($str, 1);
          };
      }else{
				$tel = '';
			}

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo '6';
          $emailError = 'メールアドレスは正しくご入力ください。';
          $validationFlag = false;
      };

      if(strlen($body) == ''){
				echo '7';
          $bodyError ='お問い合わせ内容は必須入力です。';
          $validationFlag = false;
      }

			// echo '8';

			// 変数をビューに渡す
			$body  =str_replace("\n", '<br />', $body);

			

			if($validationFlag){
				$id = $_GET['id'];
				$id = str_replace( array( '\'', '"',
				',' , ';', '<', '>' ), ' ', $id);
				DB::update("update contacts set name = '$name' , kana = '$kana', tel ='$tel', email ='$email', body ='$body' where id = $id ");
				
				// echo 'syo';
				return view('contacts.editConfirm')->with([
					"name" => $name,
					"kana"  => $kana,
					"tel"  => $tel,
					"email"  => $email,
					"body"  => $body,
				]);
			}else{
				$id = $_GET['id'];
				// echo 'syoaaa';
				return view('contacts.edit')->with([
					'id' =>  $id,
					"name" => $name,
					"kana"  => $kana,
					"tel"  => $tel,
					"email"  => $email,
					"body"  => $body,
					"validationFlag" => $validationFlag,
					// 'results' => $results,

					'nameError' => $nameError,
					'kanaError' => $kanaError,
					'telError' => $telError,
					'emailError' => $emailError,
					'bodyError' => $bodyError
			]);
			}

		}


}