<?php
	$headers = unserialize(base64_decode('YTo0OntpOjA7czoyMzoiWC1Qb3dlcmVkLUJ5OiBQSFAvNS4yLjYiO2k6MTtzOjM4OiJFeHBpcmVzOiBUaHUsIDE5IE5vdiAxOTgxIDA4OjUyOjAwIEdNVCI7aToyO3M6Nzc6IkNhY2hlLUNvbnRyb2w6IG5vLXN0b3JlLCBuby1jYWNoZSwgbXVzdC1yZXZhbGlkYXRlLCBwb3N0LWNoZWNrPTAsIHByZS1jaGVjaz0wIjtpOjM7czoxNjoiUHJhZ21hOiBuby1jYWNoZSI7fQ=='));
	$session = unserialize(base64_decode('YTo5OntzOjc6InVzZXJfaWQiO3M6NDoiMjM3MyI7czo4OiJpc19hZG1pbiI7YToxOntpOjIzNzM7YjowO31zOjE5OiJvbGRfbG9nZ2VkX2luX3ZhbHVlIjtiOjA7czo0OiJzdGF0IjthOjg6e3M6MTE6ImlzU2VhcmNoQm90IjtiOjA7czoyOiJpZCI7czozMjoiNmI0ZDllYTVlMTI2NTI1Y2RmMDU4MWUzODQ4NjY5YmQiO3M6Nzoic2l0ZV9pZCI7czoxOiIxIjtzOjc6InVzZXJfaWQiO2k6MzYyNjtzOjc6InBhdGhfaWQiO2k6NDEzNDtzOjE0OiJudW1iZXJfaW5fcGF0aCI7aTo0O3M6MTI6Imxhc3RfcGFnZV9pZCI7czoxOiI1IjtzOjEyOiJwcmV2X3BhZ2VfaWQiO3M6MToiNSI7fXM6MjQ6InNlc3Npb24tY3Jvc3Nkb21haW4tc3luYyI7aToxO3M6MzI6IjJmMjI5MmJiNDc2MzIyNjU5MzE1NDBiNjFmN2JhZmQ4IjthOjM6e2k6MDthOjM6e2k6MDtzOjc6ImNvbnRlbnQiO2k6MTtzOjA6IiI7aToyO3M6MjoiNTAiO31pOjE7YTozOntpOjA7czo3OiJjb250ZW50IjtpOjE7czowOiIiO2k6MjtzOjI6IjE2Ijt9aToyO2E6Mzp7aTowO3M6NzoiY29udGVudCI7aToxO3M6MDoiIjtpOjI7czoyOiIyMyI7fX1zOjExOiJ1bWlfY2FwdGNoYSI7czozMjoiOTgxMGZhY2JiOTA1MjI1ZTZhMzkzZjNhNTBjOGQ3ZmMiO3M6MTc6InVtaV9jYXB0Y2hhX3BsYWluIjtzOjY6Ijg1cHh3aiI7czozMjoiY2MzM2ZjNTdlNDQzNWJiMGYwMDMzNWI4Y2EwM2M5YjAiO2E6Mzp7aTowO2E6Mzp7aTowO3M6NzoiY29udGVudCI7aToxO3M6MDoiIjtpOjI7czoxOiI0Ijt9aToxO2E6Mzp7aTowO3M6NzoiY29udGVudCI7aToxO3M6MDoiIjtpOjI7czoyOiIxNiI7fWk6MjthOjM6e2k6MDtzOjc6ImNvbnRlbnQiO2k6MTtzOjA6IiI7aToyO3M6MjoiMjMiO319fQ=='));
	
	if(is_array($headers)) {
		$cmp = strtolower("Set-Cookie");
		
		for($i = 0; $i < sizeof($headers); $i++) {
			if(substr(strtolower($headers[$i]), 0, strlen($cmp)) == $cmp) {
				continue;
			} else {
				header($headers[$i]);
			}
		}
	}
	if (!session_id()) session_start();
	$_SESSION = $session;
?>