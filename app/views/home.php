<!DOCTYPE html>
<html>

<head>
    <title>9jamoji API</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style type="text/css">
        pre {
            display: block;
            padding: 9.5px;
            margin: 0 0 10px;
            font-size: 13px;
            line-height: 1.42857143;
            color: red;
            word-break: break-all;
            word-wrap: break-word;
            background-color: #000;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1>9jamoji API</h1>
                <p>This Application Programming Interface is built with <a href="www.slimframework.com">Slim</a>, using <a href="https://packagist.org/packages/illuminate/database">Eloquent ORM</a> and <a href="https://packagist.org/packages/firebase/php-jwt">Json Web Token(JWT)</a> for authentication.</p>

                <h3>Getting Started</h3>
                <hr>
                <ul>
                  <li><p> Register <a href="/register">here</a>.</p></li>
                  <li><p> Use any REST client to login and perform other operation using the routes below.</p></li>
                </ul>
                <br>
                <h4>Login</h4>
                <hr>
                    <pre>POST  http://9jamoji.herokuapp.com/auth/login</pre>
                    <p>With a similar request body</p>
                    <pre>
                    {
                        'username' : 'somebody',
                        'password' : 'password'
                    }
                    </pre>
                <p> Copy and paste the token received into the header to perform other actions.
                <br>
                <h4>Logout</h4>
                <hr>
                    <pre>GET  http://9jamoji.herokuapp.com/auth/logout</pre>
                <br>
                <h4>All Emoji</h4>
                <hr>
                    <pre>GET  http://9jamoji.herokuapp.com/emojis</pre>
                <br>
                <h4>Single Emoji</h4>
                <hr>
                    <pre>GET  http://9jamoji.herokuapp.com/emojis/{id}</pre>
                <br>
                <h4>Create Emoji</h4>
                <hr>
                    <pre>POST  http://9jamoji.herokuapp.com/emojis</pre>
                    <p>With a similar request body</p>
                    <pre>
                    {
                        'name'      : 'Sunny',
                        'char'      : 😎,
                        'keywords'  : 'Holiday, fun',
                        'category'  : 'Vacation'

                    }
                    </pre>
                <br>
                <h4>Update Emoji</h4>
                <hr>
                    <pre>PUT  http://9jamoji.herokuapp.com/emojis/{id}</pre>
                    <p>With a similar request body</p>
                    <pre>
                    {
                        'name'      : 'Noisemaker',
                        'char'      : 😷,
                        'keywords'  : 'discipline,manners',
                        'category'  : 'parenting'

                    }
                    </pre>
                <br>
                <h4>Partial Emoji Update</h4>
                <hr>
                    <pre>PATCH  http://9jamoji.herokuapp.com/emojis/{id}</pre>
                    <p>With a similar request body</p>
                    <pre>
                    {
                        'name'      : 'Twale',
                        'char'      : 🙌,
                        'keywords'  : 'Accolades',
                        'category'  : 'Respect'

                    }
                    </pre>
                <br>
                <h4>Delete Emoji</h4>
                <hr>
                    <pre>GET  http://9jamoji.herokuapp.com/emojis/{id}</pre>
            </div>

            <footer>
                <div class="container">
                    <small>Copyright | Sirolad 2015</small>
                </div>
            </footer>

        </div>
</body>

</html>
