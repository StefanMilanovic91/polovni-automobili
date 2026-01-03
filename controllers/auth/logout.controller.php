<?php
session_unset();
session_destroy();

// NOTE: Default redirect.
// TODO: Check from where user navigate and redirect there.
header('Location: /');