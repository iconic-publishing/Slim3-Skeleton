<?php

return [
	
    'auth' => [
        'remember' => 'user_r',
        'token' => getenv('AUTH_TOKEN', 32),
        'register' => getenv('AUTH_REGISTER', 32),
        'recover' => getenv('AUTH_RECOVER', 32)
    ]

];