<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .card {
            box-shadow: 0 8px 8px 10px rgba(87, 84, 84, 0.4);
            max-width: 250px;
            padding: 10px;
            margin: auto;
            text-align: center;
            border-radius: 10px;
            border: 1px solid black;
        }
        .avatar {
            width: 130px;
            height: 130px;
            border: 4px solid black;
            border-radius: 50%;
            font-size: 100px;
            margin: auto;

        }
        .designation {
            font-size: 18px;
        }
        .social {
            margin: 20px 0;
        }
        a {
            font-size: 26px;
            padding: 7px 12px;
            text-decoration: none;
            background-color: #04456f;
            color: white;
            border-radius: 10px;
        }
        a:hover {
            background-color: #00c8ff;
        }
    </style>
<script src="assets/js/view.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>

</head>
<body>
    
    <div class="card">
    <h1 style="text-align: center;">Gofit Member Card</h1>
    <h5>Jl. Centralpark No. 10 Yogyakarta</h5>
    <br>
    <br>
        <h4>NAMA   : {{$data->member_name}}</h4>
        <h4>ID     : {{substr($data->id,0,2). '.' . substr($data->id, 2, 2) . '.' . substr($data->id, 4, 3) }}</h4>
        <>Alamat  : {{$data->member_address}}</>
        <p>Telepon : {{$data->member_phone_number}}</p>
    </div>
</body>
</html>