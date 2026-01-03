<?php
session_destroy();

// NOTE: Default redirect.
// TODO: Check from where user navigate and redirect there.
header('Location: /');