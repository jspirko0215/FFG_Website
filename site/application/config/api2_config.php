<?php

$config['api_validation'] =
        array(
            'register' => array(
                array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email'
            ),
            array(
                'field' => 'height',
                'label' => 'Height',
                'rules' => 'decimal'
            ),
            array(
                'field' => 'weight',
                'label' => 'Weight',
                'rules' => 'decimal'
            ),
            array(
                'field' => 'zip',
                'label' => 'Zip',
                'rules' => 'min_length[5]|max_length[5]'
            ),
            array(
                'field' => 'email',
                'label' => 'E-mail',
                'rules' => 'required|valid_email'
            )
                
		),
		'auth' => array(
                array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required'
            )
		)
);
$config['api_transform'] = array(
    'default' => array(
        'memberLevel' => false,
        'password' => false,
        'isActive' => 'active',
        'widgets' => false,
        'forgot_code' => false,
        'post_fb' => false,
        'lastPostedFbId' => false,
        'dateOfBirth' => 'dob',
        'widgets' => false,
        'widgets' => false,
    ),
    'user' => array(
        'event_id' => false
    )
);

?>