<p>Heroku Database</p>
$url = parse_url(getenv("DATABASE_URL"));
$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

'pgsql' => [
  'driver'   => 'pgsql',
  'host'     => $host,
  'database' => $database,
  'username' => $username,
  'password' => $password,
  'charset'  => 'utf8',
  'prefix'   => '',
  'schema'   => 'public',
  ],
