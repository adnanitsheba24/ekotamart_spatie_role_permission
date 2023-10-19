@extends('frontend.master')
@section('mainpage')

    {{-- <style>
        :root {
            --card-height: 300px;
            --card-width: calc(var(--card-height) / 1.5);
            }
            * {
            box-sizing: border-box;
            }
            body {
            width: 100vw;
            height: 100vh;
            margin: 0px;
            /* display: flex; */
            /* justify-content: center; */
            /* align-items: center; */
            background: #ffffff;
            }
            .card_info {
            width: var(--card-width);
            height: var(--card-height);
            position: relative;
            /* display: flex; */
            justify-content: center;
            /* align-items: flex; */
            /* padding: 0 36px; */
            perspective: 2500px;
            /* margin-top: 100px; */
            margin-left: auto;
            }

            .cover-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            }

            .wrapper {
            transition: all 0.5s;
            position: absolute;
            width: 100%;
            z-index: -1;
            }

            .card:hover .wrapper {
            transform: perspective(900px) translateY(-5%) rotateX(25deg) translateZ(0);
            box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
            -webkit-box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 2px 35px 32px -8px rgba(0, 0, 0, 0.75);
            }

            .wrapper::before,
            .wrapper::after {
            content: "";
            opacity: 0;
            width: 100%;
            height: 80px;
            transition: all 0.5s;
            position: absolute;
            left: 0;
            }
            .wrapper::before {
            top: 0;
            height: 100%;
            background-image: linear-gradient(
                to top,
                transparent 46%,
                rgba(12, 13, 19, 0.5) 68%,
                rgba(12, 13, 19) 97%
            );
            }
            .wrapper::after {
            bottom: 0;
            opacity: 1;
            background-image: linear-gradient(
                to bottom,
                transparent 46%,
                rgba(12, 13, 19, 0.5) 68%,
                rgba(12, 13, 19) 97%
            );
            }

            .card:hover .wrapper::before,
            .wrapper::after {
            opacity: 1;
            }

            .card:hover .wrapper::after {
            height: 120px;
            }
            .title {
            width: 100%;
            transition: transform 0.5s;
            }
            .card:hover .title {
            transform: translate3d(0%, -50px, 100px);
            }

            .character {
            width: 100%;
            opacity: 0;
            transition: all 0.5s;
            position: absolute;
            z-index: -1;
            }

            .card:hover .character {
            opacity: 1;
            transform: translate3d(0%, -30%, 100px);
        }
    </style> --}}

	@section('title')
	Developer Info
	@endsection



{{-- <div></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <div class="cal-md-12 content_one">
        <div class="row">
          <div class="cal-md-6 d-flex justify-content-center">
              <a href="#" alt="Mythrill" >
                <div class="card_info">
                  <div class="wrapper">
                    <img src="{{ asset('upload/software_developer_image/software_developer_adnan.jpg') }}" class="cover-image" />
                  </div>
                  <img src="https://ggayane.github.io/css-experiments/cards/dark_rider-title.png" class="title" />
                  
                  <img src="https://ggayane.github.io/css-experiments/cards/dark_rider-character.webp" class="character" />
                </div>
                <h6 class="text-success"><span class="text-black">Name:</span>Md.Adnan Hul Huq<br>Babul</h6>
                <h6 class="text-danger"><span>Software Developer</span></h6>
              </a>

              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

              <div class="cal-md-6 d-flex justify-content-center">
                <a href="#" alt="Mythrill">
                  <div class="card_info">
                    <div class="wrapper">
                      <img src="{{ asset('upload/software_developer_image/software_developer_moula.jpg') }}" class="cover-image" />
                    </div>
                    <img src="https://ggayane.github.io/css-experiments/cards/force_mage-title.png" class="title" />
                    <img src="https://ggayane.github.io/css-experiments/cards/force_mage-character.webp" class="character" />
                  </div>
                  <h6 class="text-success"><span class="text-black">Name:</span>Md.Golam Moula</h6>
                  <h6 class="text-danger"><span>Software Developer</span></h6>
                </a>
            </div>
          </div>
        </div>
    </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

    <div></div> --}}


    <style>
      .card {
          position: relative;
          width: 225px;
          height: 320px;
          background: mediumturquoise;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 25px;
          font-weight: bold;
          /* border-radius: 15px; */
          cursor: pointer;
          margin: auto;
        }

        .card::before,
        .card::after {
          position: absolute;
          content: "";
          width: 5%;
          height: 5%;
          /* display: flex; */
          align-items: center;
          justify-content: center;
          font-size: 25px;
          font-weight: bold;
          background-color: lightblue;
          transition: all 0.5s;
        }

        .card::before {
          top: 0;
          right: 0;
          border-radius: 0 15px 0 100%;
        }

        .card::after {
          bottom: 0;
          left: 0;
          border-radius: 0 100%  0 15px;
        }

        .card:hover::before,
        .card:hover:after {
          width: 100%;
          height: 100%;
          /* border-radius: 15px; */
          transition: all 0.5s;
        }

        .card:hover:after {
          content: "Software Developer";
          text-align: center;
          color: red;
        }

    </style>


<div></div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  <div class="content_one">
    <div class="row">
      <div class="content_one card test_adnan">
        <img style="height: 225px; width: 223px;" src="{{ asset('upload/software_developer_image/software_developer_adnan.jpg') }}" alt="Img">
        <div class="text-dark" ><h6><span style="color: red"><b>Name: &nbsp;</b></span>Md.Adnan Hul Huq Babul</h6></div>
        <div class="text-dark"><h6><span style="color: red"><b>Email: &nbsp;</b></span>adnangbox@gmail.com</h6></div>
      </div>
      <div class="content_one card test_moula">
        <img style="height: 243px; width: 223px;" src="{{ asset('upload/software_developer_image/software_developer_moula.jpg') }}" alt="Img">
        <div >
          <div class="text-dark"><h6><span style="color: red"><b>Name: &nbsp;</b></span>Md.Toumal Mojumder</h6></div>
          <div class="text-dark"><h6><span style="color: red"><b>Email: &nbsp;</b></span>toumalmojumder@gmail.com</h6></div>
        </div>
      </div>
    </div>

  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div></div>
@endsection
