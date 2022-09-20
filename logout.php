<?php
	require_once('inc/session.php');

    session_destroy();
    header("Location: login");