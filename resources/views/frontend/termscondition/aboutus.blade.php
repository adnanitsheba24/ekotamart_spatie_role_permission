@extends('frontend.master')
@section('mainpage')

@section('title')
About Us || Ekota Mart
@endsection
@push('frontcss')
<link rel="stylesheet" href="{{ asset('frontend/aboutus/base.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('frontend/aboutus/fancy.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('frontend/aboutus/main.css')}}"/>
@endpush

<div class="content_one mt-5" style="min-height: 1000px;">
    <div class="container mt-5">
        <h1>About us:</h1>
        <!-- <div id="sidebar">
            <div id="outline">
            </div>
        </div> -->
        <div id="page-container" style="margin-top: 150px;">
            <div id="pf1" class="pf w0 h0" data-page-no="1">
                <div class="pc pc1 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg1.png')}}" />
                    <div class="t m0 x1 h1 y1 ff1 fs0 fc0 sc0 ls0 ws0">Company Profile of <span class="_ _0"></span><span class="ff2 fc1 sc1">Ekota<span class="fc2 sc2"> <span class="fc3 sc3">Mart</span></span></span></div>
                    <div class="t m0 x2 h2 y2 ff1 fs1 fc4 sc0 ls0 ws0">Get your choice able product in just one click.</div>
                    <div class="t m0 x3 h3 y3 ff3 fs2 fc2 sc0 ls0 ws0">+88 01906-297955</div>
                    <div class="t m0 x3 h3 y4 ff3 fs2 fc2 sc0 ls0 ws0">info@ekotamart.com</div>
                    <div class="t m0 x3 h3 y5 ff3 fs2 fc2 sc0 ls0 ws0">Mukto Bangla Shopping Complex, 5th Floor, </div>
                    <div class="t m0 x3 h3 y6 ff3 fs2 fc2 sc0 ls0 ws0">Space No:(51-52), Mirpur-1, Dhaka 1216</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf2" class="pf w0 h0" data-page-no="2">
                <div class="pc pc2 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg2.png')}}" />
                    <div class="t m0 x4 h4 y7 ff1 fs3 fc5 sc0 ls0 ws0">Here are the valuable information about Ekota Mart</div>
                    <div class="t m0 x5 h5 y8 ff4 fs4 fc5 sc4 ls0 ws0">Summary</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf3" class="pf w0 h0" data-page-no="3">
                <div class="pc pc3 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg3.png')}}" />
                    <div class="t m0 x6 h6 y9 ff3 fs5 fc6 sc0 ls0 ws0">Ekota Mart established in 8th February 2022, this B2B &amp; B2C site has already become a trusted </div>
                    <div class="t m0 x7 h6 ya ff3 fs5 fc6 sc0 ls0 ws0">marketplace for both sellers &amp; customers. Provider of an online shopping marketplace intended to </div>
                    <div class="t m0 x8 h6 yb ff3 fs5 fc6 sc0 ls0 ws0">offer branded products as well as non-branded products. The company&apos;s marketplace offers a wide </div>
                    <div class="t m0 x9 h6 yc ff3 fs5 fc6 sc0 ls0 ws0">range of goods and products ranging from clothing to electronics and also from groceries to medical </div>
                    <div class="t m0 xa h6 yd ff3 fs5 fc6 sc0 ls0 ws0">supplies, enabling consumers to access a wide range of products accessible all in one place with a free </div>
                    <div class="t m0 xb h6 ye ff3 fs5 fc6 sc0 ls0 ws0">delivery facility.</div>
                    <div class="t m0 xc h6 yf ff3 fs5 fc6 sc0 ls0 ws0"> Ekota Mart is a one of the company in Monir Group of Companies. Ekota Mart is lead by its Chairman </div>
                    <div class="t m0 xa h6 y10 ff3 fs5 fc6 sc0 ls0 ws0">&amp; CEO Md. Monirul Islam who is recognized as the most successful entrepreneur in the travel industry </div>
                    <div class="t m0 xd h6 y11 ff3 fs5 fc6 sc0 ls0 ws0">of Bangladesh. He is also the CEO of Amanot Travels International.</div>
                    <div class="t m0 xe h7 y12 ff2 fs4 fc7 sc5 ls0 ws0">Summary</div>
                    <div class="t m0 xf h8 y13 ff5 fs6 fc7 sc0 ls0 ws0">A short brief about Ekota Mart</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf4" class="pf w0 h0" data-page-no="4">
                <div class="pc pc4 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg4.png')}}" />
                    <div class="t m0 x10 h9 y14 ff6 fs1 fc7 sc0 ls0 ws0">Who we are:</div>
                    <div class="t m0 x10 ha y15 ff7 fs1 fc0 sc0 ls0 ws0">Ekota <span class="_ _1"> </span>Mart <span class="_ _1"> </span>is <span class="_ _1"> </span>determined <span class="_ _1"> </span>to <span class="_ _1"> </span>bring <span class="_ _1"> </span>a <span class="_ _2"> </span>large <span class="_ _1"> </span>number <span class="_ _1"> </span>of <span class="_ _1"> </span>products <span class="_ _1"> </span>to <span class="_ _1"> </span>the </div>
                    <div class="t m0 x10 ha y16 ff7 fs1 fc0 sc0 ls0 ws0">doorstep <span class="_ _3"> </span>by <span class="_ _4"> </span>the <span class="_ _4"> </span>e-commerce <span class="_ _3"> </span>service <span class="_ _3"> </span>of <span class="_ _3"> </span>the <span class="_ _4"> </span>buyers <span class="_ _3"> </span>from <span class="_ _4"> </span>home <span class="_ _4"> </span>and <span class="_ _4"> </span>abroad </div>
                    <div class="t m0 x10 ha y17 ff7 fs1 fc0 sc0 ls0 ws0">considering <span class="_ _5"></span>the <span class="_ _6"> </span>growing <span class="_ _5"></span>demand <span class="_ _6"> </span>of <span class="_ _6"> </span>the <span class="_ _6"> </span>buyers. <span class="_ _6"></span>From <span class="_ _5"></span>this <span class="_ _6"> </span>site, <span class="_ _6"> </span>customers </div>
                    <div class="t m0 x10 ha y18 ff7 fs1 fc0 sc0 ls0 ws0">can <span class="_ _7"> </span>buy <span class="_ _7"> </span>various <span class="_ _7"> </span>products <span class="_ _8"> </span>including <span class="_ _8"> </span>household <span class="_ _7"> </span>goods, <span class="_ _8"> </span>electrical <span class="_ _7"> </span>and </div>
                    <div class="t m0 x10 ha y19 ff7 fs1 fc0 sc0 ls0 ws0">electronics, <span class="_ _9"></span>boutiques. <span class="_ _9"></span>It help <span class="_ _a"></span>customer <span class="_ _9"></span>to choose <span class="_ _a"></span>the pure <span class="_ _9"></span>product which </div>
                    <div class="t m0 x10 ha y1a ff7 fs1 fc0 sc0 ls0 ws0">was selected by our own staff.</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf5" class="pf w0 h0" data-page-no="5">
                <div class="pc pc5 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg5.png')}}" />
                    <div class="t m0 xe h3 y1b ff3 fs2 fc6 sc0 ls0 ws0">Our main goal to give </div>
                    <div class="t m0 x11 h3 y1c ff3 fs2 fc6 sc0 ls0 ws0">customer that </div>
                    <div class="t m0 x12 h3 y1d ff3 fs2 fc6 sc0 ls0 ws0">satisfaction what they </div>
                    <div class="t m0 x13 h3 y1e ff3 fs2 fc6 sc0 ls0 ws0">need.</div>
                    <div class="t m0 x10 hb y1f ff5 fs5 fc6 sc0 ls0 ws0">Customer Satisfaction</div>
                    <div class="t m0 x14 h3 y20 ff3 fs2 fc6 sc0 ls0 ws0">We got 99% with </div>
                    <div class="t m0 x15 h3 y21 ff3 fs2 fc6 sc0 ls0 ws0">On time delivery record. </div>
                    <div class="t m0 x16 hb y22 ff5 fs5 fc6 sc0 ls0 ws0">On time Delivery</div>
                    <div class="t m0 x17 h3 y23 ff3 fs2 fc6 sc0 ls0 ws0">We ensure our product </div>
                    <div class="t m0 x18 h3 y24 ff3 fs2 fc6 sc0 ls0 ws0">with 100% natural.</div>
                    <div class="t m0 x19 hb y25 ff5 fs5 fc6 sc0 ls0 ws0">100% Natural</div>
                    <div class="t m0 x1a h3 y26 ff3 fs2 fc6 sc0 ls0 ws0">All our products are hand </div>
                    <div class="t m0 x1b h3 y27 ff3 fs2 fc6 sc0 ls0 ws0">picked and 100% fresh.</div>
                    <div class="t m0 x1c hb y28 ff5 fs5 fc6 sc0 ls0 ws0">Hand Picked Product</div>
                    <div class="t m0 x1d h3 y29 ff3 fs2 fc6 sc0 ls0 ws0">We deliver your chosen </div>
                    <div class="t m0 x1e h3 y2a ff3 fs2 fc6 sc0 ls0 ws0">product safely to your </div>
                    <div class="t m0 x1f h3 y2b ff3 fs2 fc6 sc0 ls0 ws0">home.</div>
                    <div class="t m0 x20 hb y2c ff5 fs5 fc6 sc0 ls0 ws0">Home Delivery</div>
                    <div class="t m0 x21 h9 y2d ff6 fs1 fc7 sc0 ls0 ws0">Our Goal :</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf6" class="pf w0 h0" data-page-no="6">
                <div class="pc pc6 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg6.png')}}" />
                    <div class="t m0 x12 h9 y2e ff6 fs1 fc7 sc0 ls0 ws0">Our Product</div>
                    <div class="t m0 x12 hc y2f ff3 fs7 fc2 sc0 ls0 ws0">Our <span class="_ _b"> </span>main <span class="_ _b"> </span>goal <span class="_ _b"> </span>to <span class="_ _c"> </span>give <span class="_ _c"> </span>customer </div>
                    <div class="t m0 x12 hc y30 ff3 fs7 fc2 sc0 ls0 ws0">that <span class="_ _d"> </span>satisfaction <span class="_ _e"> </span>what they <span class="_ _d"> </span>need. </div>
                    <div class="t m0 x12 hc y31 ff3 fs7 fc2 sc0 ls0 ws0">We <span class="_ _0"></span>ensure <span class="_ _0"></span>our <span class="_ _0"></span>product <span class="_ _0"></span>with <span class="_ _f"></span>100% </div>
                    <div class="t m0 x12 hc y32 ff3 fs7 fc2 sc0 ls0 ws0">natural. <span class="_ _c"> </span>We <span class="_ _b"> </span>deliver <span class="_ _1"> </span>your <span class="_ _b"> </span>chosen </div>
                    <div class="t m0 x12 hc y33 ff3 fs7 fc2 sc0 ls0 ws0">product safely to your home.</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf7" class="pf w0 h0" data-page-no="7">
                <div class="pc pc7 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg7.png')}}" />
                    <div class="t m0 x22 hd y34 ff5 fs8 fc2 sc0 ls1 ws0">Company<span class="ls2"> Name<span class="_ _10"> </span><span class="ff3 ls0">Ekota Mart</span></span></div>
                    <div class="t m0 x22 hd y35 ff5 fs8 fc2 sc0 ls0 ws0">Type<span class="_ _a"></span><span class="ls3"> <span class="ls0">of</span> <span class="ls1">Organization<span class="_ _11"> </span><span class="ff3 ls0">Proprietorship<span class="_ _9"></span><span class="ls4"> <span class="ls1">Company</span></span></span></span></span></div>
                    <div class="t m0 x22 hd y36 ff5 fs8 fc2 sc0 ls0 ws0">Date<span class="_ _a"></span><span class="ls3"> <span class="ls0">of</span> <span class="ls1">Establishment</span></span></div>
                    <div class="t m0 x23 he y37 ff3 fs8 fc2 sc0 ls0 ws0">8th February 2022</div>
                    <div class="t m0 x22 hd y38 ff5 fs8 fc2 sc0 ls1 ws0">Address</div>
                    <div class="t m0 x24 he y39 ff3 fs8 fc2 sc0 ls0 ws0">Mukto Bangla Shopping Complex, <span class="_ _a"></span>5</div>
                    <div class="t m0 x25 hf y3a ff3 fs9 fc2 sc0 ls0 ws0">th</div>
                    <div class="t m0 x26 he y39 ff3 fs8 fc2 sc0 ls0 ws0"> Floor, </div>
                    <div class="t m0 x24 he y3b ff3 fs8 fc2 sc0 ls0 ws0">Space No:51-52, <span class="_ _0"></span>Mirpur-1, Dhaka 1216, Bangladesh</div>
                    <div class="t m0 x22 hd y3c ff5 fs8 fc2 sc0 ls1 ws0">Telephone/Mobile<span class="_ _12"> </span><span class="ff3 ls0">+880-<span class="ls1">1906-297 <span class="_ _0"></span>955</span></span></div>
                    <div class="t m0 x22 hd y3d ff5 fs8 fc2 sc0 ls2 ws0">Email<span class="_ _13"> </span><span class="ff3 ls0">info@ekotamart.com</span></div>
                    <div class="t m0 x22 hd y3e ff5 fs8 fc2 sc0 ls1 ws0">Website<span class="_ _14"> </span><span class="ff3 ls0">www.ekotamart.com</span></div>
                    <div class="t m0 x22 hd y3f ff5 fs8 fc2 sc0 ls0 ws0">Bank Name<span class="_ _15"> </span><span class="ff3">Islami Bank Bangladesh Limited</span></div>
                    <div class="t m0 x22 hd y40 ff5 fs8 fc2 sc0 ls0 ws0">Bank Information</div>
                    <div class="t m0 x23 he y41 ff3 fs8 fc2 sc0 ls0 ws0">C/A: 20507640100002410</div>
                    <div class="t m0 x23 he y42 ff3 fs8 fc2 sc0 ls0 ws0">SWIFT Code: IBBLBDDH210</div>
                    <div class="t m0 x23 he y43 ff3 fs8 fc2 sc0 ls0 ws0">Islami Bank Bangladesh Limited</div>
                    <div class="t m0 x23 he y44 ff3 fs8 fc2 sc0 ls0 ws0">Mirpur-1 Sub Branch</div>
                    <div class="t m0 x27 h10 y45 ff2 fsa fc7 sc5 ls0 ws0">CORPORATE PROFILE:</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf8" class="pf w0 h0" data-page-no="8">
                <div class="pc pc8 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg8.png')}}" />
                    <div class="t m0 x28 h10 y46 ff2 fsa fc7 sc5 ls0 ws0">CORPORATE PROFILE:</div>
                    <div class="t m0 x29 h11 y47 ff5 fs1 fc5 sc0 ls0 ws0">Sl No.<span class="_ _16"> </span>Name<span class="_ _17"> </span>Designation</div>
                    <div class="t m0 x2a h12 y48 ff3 fs1 fc2 sc0 ls0 ws0">1</div>
                    <div class="t m0 x2b h12 y49 ff3 fs1 fc2 sc0 ls0 ws0">Md. Monirul Islam<span class="_ _18"> </span>Proprietor &amp; CEO</div>
                    <div class="t m0 x2a h12 y4a ff3 fs1 fc2 sc0 ls0 ws0">2</div>
                    <div class="t m0 x2b h12 y4b ff3 fs1 fc2 sc0 ls0 ws0">Syeda Farhana Aktar Mithila <span class="_ _19"> </span>Manager</div>
                    <div class="t m0 x2a h12 y4c ff3 fs1 fc2 sc0 ls0 ws0">3</div>
                    <div class="t m0 x2b h12 y4d ff3 fs1 fc2 sc0 ls0 ws0">MD. Shariful Islam <span class="_ _1a"> </span>Manager</div>
                    <div class="t m0 x2a h12 y4e ff3 fs1 fc2 sc0 ls0 ws0">4</div>
                    <div class="t m0 x2b h12 y4f ff3 fs1 fc2 sc0 ls0 ws0">Sadia Afrin Heya<span class="_ _1b"> </span>Marketing Executive</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pf9" class="pf w0 h0" data-page-no="9">
                <div class="pc pc9 w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bg9.png')}}" />
                    <div class="t m0 x2c h10 y50 ff2 fsa fc7 sc5 ls0 ws0">Details of Our Group:</div>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
            <div id="pfa" class="pf w0 h0" data-page-no="a">
                <div class="pc pca w0 h0"><img class="bi x0 y0 w0 h0" alt="" src="{{ asset('frontend/aboutus/bga.png')}}" />
                    <div class="t m0 x2d h5 y51 ff8 fs4 fc8 sc0 ls0 ws0">THANK YOU</div>
                    <div class="t m0 x2e h13 y52 ff9 fs2 fc2 sc0 ls0 ws0">Contact Information:</div>
                    <div class="t m0 x2e h14 y53 ff5 fs2 fc2 sc0 ls0 ws0">Mobile: <span class="ff3 fc0">+8801906-297955</span></div>
                    <div class="t m0 x2e h14 y54 ff5 fs2 fc2 sc0 ls0 ws0">Email: <span class="ff3 fc9">info@itsheba24.com</span></div>
                    <div class="t m0 x2e h14 y55 ff5 fs2 fc2 sc0 ls0 ws0">Website: <span class="_ _9"></span><span class="ff3 fc9">www.itsheba24.com<span class="_ _9"></span><span class="fc0"> </span></span></div>
                    <div class="t m0 x2e h14 y56 ff5 fs2 fc2 sc0 ls0 ws0">Address: <span class="ff3 fc0">Mukto Bangla Shopping Complex, 4</span></div>
                    <div class="t m0 x2f h15 y57 ff3 fsb fc0 sc0 ls0 ws0">th</div>
                    <div class="t m0 x30 h3 y56 ff3 fs2 fc0 sc0 ls0 ws0"> Floor, </div>
                    <div class="t m0 x2e h3 y58 ff3 fs2 fc0 sc0 ls0 ws0">Space No: (13-17), Mirpur-1, Dhaka 1216,</div><a class="l" href="mailto:info@itsheba24.com">
                        <div class="d m1" style="border-style:none;position:absolute;left:517.751404px;bottom:236.929871px;width:118.712891px;height:17.089844px;background-color:rgba(255,255,255,0.000001);"></div>
                    </a><a class="l" href="http://www.itsheba24.com">
                        <div class="d m1" style="border-style:none;position:absolute;left:533.013123px;bottom:211.729889px;width:117.530273px;height:17.089844px;background-color:rgba(255,255,255,0.000001);"></div>
                    </a>
                </div>
                <div class="pi" data-data='{"ctm":[1.000000,0.000000,0.000000,1.000000,0.000000,0.000000]}'></div>
            </div>
        </div>
        <div class="loading-indicator">

        </div>
    </div>
</div>
@push('custom-scripts')
<script src="{{ asset('frontend/aboutus/compatibility.min.js') }}"></script>
<script src="{{ asset('frontend/aboutus/theViewer.min.js') }}"></script>
@endpush


<script>
try{
theViewer.defaultViewer = new theViewer.Viewer({});
}catch(e){}
</script>
@endsection