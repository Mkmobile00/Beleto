<?php
namespace App\Http\Traits;


trait ArrayTrait{

    function colorThemes(){
        return[
            [
                'title'=>'Default',
                'value'=>'0'
            ],
            [
                'title'=>'Green',
                'value'=>'1'
            ],
            [
                'title'=>'Blue',
                'value'=>'2'
            ],
            [
                'title'=>'Red',
                'value'=>'3'
            ],
            [
                'title'=>'Yellow',
                'value'=>'4'
            ]
        ];
    }

    function headerTemplates(){
        return[
            [
                'title'=>'Header Default',
                'value'=>'0'
            ],
            [
                'title'=>'Header 2',
                'value'=>'1'
            ],
            [
                'title'=>'Header 3',
                'value'=>'2'
            ],
            [
                'title'=>'Header 4',
                'value'=>'3'
            ],
            [
                'title'=>'Header 5',
                'value'=>'4'
            ]
        ];
    }

    function footerTemplates(){
        return[
            [
                'title'=>'Footer Default',
                'value'=>'0'
            ],
            [
                'title'=>'Footer 2',
                'value'=>'1'
            ],
            [
                'title'=>'Footer 3',
                'value'=>'2'
            ],
            [
                'title'=>'Footer 4',
                'value'=>'3'
            ],
            [
                'title'=>'Footer 5',
                'value'=>'4'
            ]
        ];
    }

    function preLoaders(){
        return[
            [
                'title'=>'Grid',
                'value'=>'0'
            ],
            [
                'title'=>'Vertical',
                'value'=>'1'
            ]
        ];
    }

    function confirmations(){
        return[
            [
                'title'=>'Yes',
                'value'=>'1'
            ],
            [
                'title'=>'No',
                'value'=>'0'
            ]
        ];
    }

    function mailType(){
        return[
            [
                'title'=>'SMTP (Recommanded)',
                'value'=>'smtp'
            ],
            [
                'title'=>'Send Mail',
                'value'=>'mail'
            ]
        ];
    }
    function smtpCrypto(){
        return[
            [
                'title'=>'SSL',
                'value'=>'ssl'
            ],
            [
                'title'=>'TLS',
                'value'=>'tls'
            ]
        ];
    }
}