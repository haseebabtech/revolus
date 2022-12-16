<html>
    <head>
        <style>
            .signin-button > div > div > svg {  
                height: 50px;  
                width: 100%;  
            }
        </style>
    </head>
    <body>
        <script type="text/javascript" src="https://appleid.cdn-apple.com/appleauth/static/jsapi/appleid/1/en_US/appleid.auth.js"></script>
        <div id="appleid-signin" data-color="black" data-border="true" data-type="sign in"></div>
        <script type="text/javascript">
            AppleID.auth.init({
                clientId : 'com.revolus.llc.service',
                scope : "name email",
                redirectURI: 'https://revolus.com/applesignin',
                state : '<?php echo bin2hex(random_bytes(5)); ?>'
            });
        </script>
    </body>
</html>

<?php
die;
?>