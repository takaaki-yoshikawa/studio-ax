// ヘッダー設定
		$header = '';
		$header .= "Content-Type: multipart/mixed;boundary=\"__BOUNDARY__\"\n";
		$header .= "Return-Path: " . $fromEmail . " \n";
		$header .= "From: " . $fromName ." \n";
		$header .= "Sender: " . $fromName ." \n";
		$header .= "Reply-To: " . $fromEmail . " \n";
		$header .= "Organization: " . $fromName . " \n";
		$header .= "X-Sender: " . $fromName . " \n";
		$header .= "X-Priority: 3 \n";

        if ($begginercheck == 0) {
			// 管理者用
			$body = "--__BOUNDARY__\n";
			$body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body .= $text . "\n";
			$body .= "--__BOUNDARY__\n";

			// 利用者用
			$body2 = "--__BOUNDARY__\n";
			$body2 .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body2 .= $text2 . "\n";
			$body2 .= "--__BOUNDARY__\n";
			
			// // ファイルを添付
			// $body .= "Content-Type: application/octet-stream; name=\"{$clean}\"\n";
			// $body .= "Content-Disposition: attachment; filename=\"{$clean}\"\n";
			// $body .= "Content-Transfer-Encoding: base64\n";
			// $body .= "\n";
			// $body .= chunk_split(base64_encode(file_get_contents(FILE_DIR."/src/images/card/".$clean)));
			// $body .= "--__BOUNDARY__--";
		}else{
			// 管理者用
			$body = "--__BOUNDARY__\n";
			$body .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body .= $text . "\n";
			$body .= "--__BOUNDARY__\n";
			// ファイルを添付
			$body .= "Content-Type: application/octet-stream; name=\"{$clean}\"\n";
			$body .= "Content-Disposition: attachment; filename=\"{$clean}\"\n";
			$body .= "Content-Transfer-Encoding: base64\n";
			$body .= "\n";
			$body .= chunk_split(base64_encode(file_get_contents(FILE_DIR."/src/images/card/".$clean)));
			$body .= "--__BOUNDARY__--";


			// 利用者用
			$body2 = "--__BOUNDARY__\n";
			$body2 .= "Content-Type: text/plain; charset=\"ISO-2022-JP\"\n\n";
			$body2 .= $text2 . "\n";
			$body2 .= "--__BOUNDARY__\n";