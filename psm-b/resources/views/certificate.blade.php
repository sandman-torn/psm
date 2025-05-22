<!DOCTYPE html>
<html>

<head>
  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      font-family: 'Arial', sans-serif;
      position: relative;
    }

    .bg-image {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 0;
      /* opacity: 0.3; optional to fade image */
    }

    .content {
      position: relative;
      z-index: 1;
      text-align: center;
      margin-top: 25%;
      color: #000;
    }

    .name {
      font-size: 32px;
      font-weight: bold;
    }

    .ayat {
      font-size: 20px;
    }

    .tajuk {
      font-size: 20px;
      font-weight: bold;
    }

    .qr {
      position: absolute;
      top: 70px;
      right: 50px;
    }

    .ayatqr {
      position: absolute;
      font-weight: bold;
      top: 40px;
      right: 50px;
    }
  </style>
</head>

<body>

  <img src="{{ public_path('images/certificate-bg.jpg') }}" class="bg-image" />
  <div class="content">

    <div class="name" style="margin-bottom: 10px;">{{ $participant->user->name }}</div>
    <div class="tajuk">{{ $participant->user->ic_no}}</div>
    <br>
    <div class="ayat">Telah Menyertai Program</div>
    <div class="tajuk">{{ $program->program_name }}</div>
    <br>
    <div class="ayat">Pada</div>

    <div class="tajuk"> {{ \Carbon\Carbon::parse($program->date_from)->format('d M Y') }} hingga
      {{ \Carbon\Carbon::parse($program->date_to)->format('d M Y') }}
    </div>
    <br>
    <div class="ayat">Bertempat di</div>
    <div class="tajuk">{{ $program->location }}</div>
    <br>
    <div class="ayat">Anjuran</div>
    <div class="tajuk">Perbendaharaan Negeri Johor</div>


  </div>

  <div class="qr">
    <img src="{{ $qrImagePath }}" width="100">
  </div>
  <div class="ayatqr">Sijil No : {{ $participant->certificate_code }}</div>
</body>

</html>