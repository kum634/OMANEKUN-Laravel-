<!DOCTYPE html>
<html lang="ja">
<style>
  body {
    text-align: center;
  }
  h1 {
    font-size: 16px;
    color: #212529;
    margin-top: 35px;
  }
  #button {
    width: 200px;
    text-align: center;
    border-radius :0.3rem;
    margin: 35px auto;
  }
  #button a {
    padding: 10px 20px;
    display: block;
    border: 1px solid #28a745;
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    box-shadow: 2px 2px 3px #f5deb3;
    border-radius :0.3rem;
  }
  #button a:hover {
    background-color: #218838;
    color: #1e7e34;
  }
</style>
<body>
<h1>
  パスワードリセット
</h1>
<p>
  以下のリンクを押下し、パスワードリセットの手続きを行ってください。
</p>
<p id="button">
  <a href="{{$reset_url}}">パスワードの変更</a>
</p>
</body>
</html>
