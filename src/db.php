<?php
	function connectMysql(string $dsn,string $dbuser,string $passdb){
		try{
			$db = new PDO($dsn, $dbuser, $passdb);

			$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);

		}catch(PDOException $e){
			die( $e->getMessage());
			
		}
		return $db;
	}

	function auth(PDO $db, string $email, string $passwd):stdClass {
		$stmt = $db->prepare(
			"SELECT * FROM users WHERE email = :email LIMIT 1;"
		);
		$stmt->execute([
			':email' => $email
		]);

		if ($stmt) {
			$user = $stmt->fetch();
			if (
				$stmt->rowCount() == 1 &&
				password_verify($passwd, ($user->passwd))
			) {
				return $user;
			} else {
				return new stdClass();
			}
		} else {
			return new stdClass();
		}
	}

	function authHashed(PDO $db, string $email, string $passwd):stdClass {
		$stmt = $db->prepare(
			"SELECT * FROM users WHERE email = :email LIMIT 1;"
		);
		$stmt->execute([
			':email' => $email
		]);

		if ($stmt) {
			$user = $stmt->fetch();
			if (
				$stmt->rowCount() == 1 &&
				$passwd == $user->passwd
			) {
				return $user;
			} else {
				return new stdClass();
			}
		} else {
			return new stdClass();
		}
	}

	

	function signupUser(
		PDO $db,
		string $fullname, string $email,
		string $passwd, string $passwdConfirm,
		bool $isProf
	):stdClass {
		if (
			signupUserValidate(
				$db,
				$fullname, $email,
				$passwd, $passwdConfirm,
				$isProf
			)
		) {
			$passwd_encrypted = password_hash($passwd, PASSWORD_BCRYPT, ['cost'=>4]);
			$stmt = $db->prepare(
				"INSERT INTO users VALUES
					(LAST_INSERT_ID(), :fullname,:email,:passwd,".((isset($isProf) && ($isProf == 'on' || $isProf == true))? 1:0).")
				;"
			);
			$stmt->execute([
				':fullname' => $fullname,
				':email' => $email,
				':passwd' => $passwd_encrypted
			]);
			if ($stmt) {
				$lastID = (int)($db->lastInsertId());

				$stmt = $db->prepare(
					"SELECT * FROM users WHERE id = :id;"
				);
				$stmt->execute([':id' => $lastID]);

				$user = $stmt->fetch();
				if ($stmt->rowCount() == 1) {
					return $user;
				} else {
					return new stdClass();
				}
			} else {
				return new stdClass();
			}
		} else {
			return new stdClass();
		}
	}

	function signupUserValidate(
		PDO $db,
		string $fullname, string $email,
		string $passwd, string $passwdConfirm,
		bool $isProf
	):bool {
		$stmt = $db->prepare(
			"SELECT * FROM users
			WHERE (fullname = :fullname OR email = :email);"
		);
		$stmt->execute([
			':fullname' => $fullname,
			':email' => $email
		]);
		
		if ($stmt) {
			$user = $stmt->fetchAll();
			if (
				$stmt->rowCount() < 1 &&
				$passwd == $passwdConfirm
			) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	function findUserByEmail(
		PDO $db, string $email
	):stdClass {
		$stmt = $db->prepare(
			"SELECT * FROM users
			WHERE (email = :email);"
		);
		$stmt->execute([':email' => $email]);
		
		if ($stmt) {
			$user = $stmt->fetch();
			if ($stmt->rowCount() == 1) {
				return $user;
			} else {
				return new stdClass();
			}
		} else {
			return new stdClass();
		}
	}

	function createNewUserSettingsEntry(
		PDO $db, string $email
	):stdClass {
		$stmt = $db->prepare("SELECT NOW();");
		$stmt->execute([]);

		if ($stmt) {
			$dt = $stmt->fetch(PDO::FETCH_NUM)[0];
		} else {
			return new stdClass();
		}

		if (($user = findUserByEmail($db, $email)) <> new stdClass()) {
			$userid = $user->id;
			$stmt = $db->prepare(
				"INSERT INTO user_settings (userid, lastLogin, language, colorTheme)
				VALUES
					(:userid, :lastLogin, 'en', 'light_default')
				;"
			);
			$stmt->execute([
				':userid' => $userid,
				':lastLogin' => $dt
			]);

			if ($stmt) {
				return fetchUserSettingsWithUserId($db, $userid);
			} else {
				return new stdClass();
			}
		} else {
			return new stdClass();
		}
	}

	function fetchUserSettingsWithUserId(
		PDO $db, $userid
	):stdClass {
		$stmt = $db->prepare(
			"SELECT * FROM user_settings WHERE userid = :userid;"
		);
		$stmt->execute([':userid' => $userid]);

		$user_settings = $stmt->fetch();
		if ($stmt->rowCount() == 1) {
			return $user_settings;
		} else {
			return new stdClass();
		}
	}
	
	function updateUserSettingsWithUserId(
		PDO $db,
		$userid, $lastLogin, $lastLogout,
		$language, $colorTheme
	):stdClass {
		$stmt = $db->prepare(
			"UPDATE user_settings SET
			lastLogin = :lastLogin,
			lastLogout = :lastLogout,
			language = :language,
			colorTheme = :colorTheme
			WHERE userid = :userid;"
		);
		$stmt->execute([
			':userid' => $userid,
			':lastLogin' => $lastLogin,
			':lastLogout' => $lastLogout,
			':language' => $language,
			':colorTheme' => $colorTheme
		]);
		if ($stmt) {
			$user_settings = fetchUserSettingsWithUserId($db, $userid);
			return $user_settings;
		} else {
			return new stdClass();
		}
	}
	function updateUserLastLoginWithUserId(
		PDO $db, $userid, $lastLogin
	):stdClass {
		$stmt = $db->prepare(
			"UPDATE user_settings SET
			lastLogin = :lastLogin
			WHERE userid = :userid;"
		);
		$stmt->execute([
			':userid' => $userid,
			':lastLogin' => $lastLogin
		]);
		if ($stmt) {
			$user_settings = fetchUserSettingsWithUserId($db, $userid);
			return $user_settings;
		} else {
			return new stdClass();
		}
	}
?>