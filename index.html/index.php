<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Karang Taruna | Sistem Informasi Pesanan</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
}

body{
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#0f2027,#203a43,#2c5364);
    overflow:hidden;
}

/* Background Animation */
body::before{
    content:'';
    position:absolute;
    width:450px;
    height:450px;
    background:#00d4ff;
    border-radius:50%;
    top:-150px;
    left:-150px;
    filter:blur(120px);
    opacity:.25;
}

body::after{
    content:'';
    position:absolute;
    width:400px;
    height:400px;
    background:#00ffb3;
    border-radius:50%;
    bottom:-120px;
    right:-120px;
    filter:blur(120px);
    opacity:.18;
}

.container{
    position:relative;
    width:380px;
    padding:40px 35px;
    border-radius:20px;
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(15px);
    border:1px solid rgba(255,255,255,.15);
    box-shadow:0 20px 40px rgba(0,0,0,.4);
    text-align:center;
    z-index:10;
}

.logo{
    width:90px;
    height:90px;
    margin:auto;
    margin-bottom:20px;
    border-radius:50%;
    background:linear-gradient(135deg,#45f3ff,#00c6ff);
    display:flex;
    justify-content:center;
    align-items:center;
    color:#0f2027;
    font-size:38px;
    font-weight:bold;
    box-shadow:0 10px 25px rgba(69,243,255,.35);
}

h1{
    color:#fff;
    font-size:28px;
    margin-bottom:8px;
}

.subtitle{
    color:#c9d6df;
    font-size:15px;
    margin-bottom:35px;
}

.btn{
    width:100%;
    display:block;
    padding:14px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    margin-bottom:15px;
    transition:.3s;
}

.btn-login{
    background:#45f3ff;
    color:#0f2027;
}

.btn-login:hover{
    background:#2ee0ef;
    transform:translateY(-3px);
    box-shadow:0 10px 20px rgba(69,243,255,.3);
}

.btn-register{
    border:2px solid #45f3ff;
    color:#45f3ff;
    background:transparent;
}

.btn-register:hover{
    background:#45f3ff;
    color:#0f2027;
    transform:translateY(-3px);
}

.footer{
    margin-top:25px;
    color:#b5c5cf;
    font-size:13px;
}

@media(max-width:450px){
    .container{
        width:90%;
        padding:35px 25px;
    }
}
</style>

</head>

<body>

<div class="container">

    <div class="logo">KT</div>

    <h1>Karang Taruna</h1>

    <p class="subtitle">
        Sistem Informasi Pesanan<br>
        <small>Kelola pesanan dengan cepat, mudah, dan profesional.</small>
    </p>

    <a href="login.php" class="btn btn-login">
        🔐 Login
    </a>

    <a href="register.php" class="btn btn-register">
        📝 Daftar Akun
    </a>

    <div class="footer">
        © 2026 Karang Taruna
    </div>

</div>

</body>
</html>