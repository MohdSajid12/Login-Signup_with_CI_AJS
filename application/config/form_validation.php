<?php   
   $config = [
   'add_article_rules' => [
                      [
                        'field' => 'firstname',
                        'title'=> 'firstname',
                        'rules' => 'required'
                      ],
                      [
                        'field' => 'email',
                        'title'=> 'email',
                        'rules' => 'required'
                      ],
                      [
                        'field' => 'password',
                        'title'=> 'password',
                        'rules' => 'required'
                      ],
                      [
                        'field' => 'conpassword',
                        'title'=> 'password',
                        'rules' => 'required|matches[password]'
                      ]

                      ]
                    ]
                    
?>