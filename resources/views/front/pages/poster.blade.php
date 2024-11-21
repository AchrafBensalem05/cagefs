<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $entity->name }}  Sharing Poster</title>
    <link rel="stylesheet" href="{{ asset('poster/poster.css') }}">
    <style>
        svg {
            height: 90%;
            width: 100%;
            margin-top: 5%;
        }

        /*-------
        @media print {
            body{
                display:none;
            }
             svg {
                display: block;
            }
        }
        ---------*/
    </style>

</head>
<body onclick="captureScreenshot()">
<div class="background-1">
    <!--------tous les blancs div ---------------->
    <div class="white-dvs white-upper-dv">
        <span class="title">إكـتشف طـريقة جديـدة للحجـز</span>
        <div class="white-upper-logo-dv">
            <img src="{{ asset('poster/logo zellig circle.svg') }}" alt="">
        </div>
        <div class="text-dv">
            <span class="text">مـنصـة شــريـان، منـصة حــــديثة تعمـل</span>
            <span class="text">على تقريب الخدمات الصحية من الناس</span>
        </div>
        <span class="app-title">chiriane</span>
    </div>

    <div class="white-dvs white-center-dv">
        <div class="identifiant-account">
            <div class="name">
                <span class="account-label">
                    @if($entity->type != 4)
                    <span>Dr.</span>
                    @else
                    <span>Pha.</span>
                    @endif
                </span>
                <span class="account-name">&nbsp;{{ $entity->fname }} {{ $entity->lname }}</span>
            </div>
            <div class="username">{{ $entity->name }}</div>
        </div>
        <div class="white-dvs white-center1-dv">
            <div class="white-dvs white-center2-dv">
                {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(370)->generate(route('front.get_healthcare_entity_page' , $entity->slug)) !!}
            </div>
        </div>
    </div>

    <div class="white-dvs white-bellow-dv"></div>

    <!--------tous les grona div ---------------->
    <div class="grona-dvs grona-dv1"></div>
    <div class="grona-dvs grona-dv2"></div>
    <div class="grona-dvs grona-dv3"></div>
    <div class="grona-dvs grona-dv4"></div>
    <div class="grona-dvs grona-dv5"></div>
    <div class="grona-dvs grona-dv6"></div>
    <div class="grona-dvs grona-dv7"></div>

    <!--------tous les bottom links-------------->
    <div class="bottom-links">
        <span class="links-title">تابع حساباتنا</span>
        <div class="links-icon">
            <img src="{{ asset('poster/Twitter.svg') }}"  alt="">
            <img src="{{ asset('poster/Facebook.svg') }}" style="width:41px;margin: 0 auto;" alt="">
            <img src="{{ asset('poster/YouTube.svg') }}" style="width:43px;margin: 5px auto;" alt="">
            <img src="{{ asset('poster/LinkedIn.svg') }}" style="width:38px; margin-left: 3.5px;" alt="">
            <img src="{{ asset('poster/TikTok.svg') }}" alt="">
        </div>
        <div class="links">
            <p>x.com/ChirianePlatfrm</p>
            <p>fb.com/ChirianePlatform</p>
            <p>youtu.be/Chirianeplatform</p>
            <p>linkedin.com/chirianeplatform</p>
            <p>tiktok.com/@chirianeplatform</p>
        </div>

        <span class="links-title">التطبيق متوفر على</span>
        <div class="app-download">
            <img src="{{ asset('poster/google play logo.svg') }}" alt="">
            <img src="{{ asset('poster/app store logo.svg') }}" alt="">
        </div>
    </div>

    <div class="help">

        <div class="help-txt-phone">
            <div class="help-txt">
                <div class="hlp-txt-ttl">1</div>
                <div class="hlp-txt-dscrptn">قم بعمل مسح للكود كي آر بعدها أدخل على رابط الصفحة الشخصية للطبيب</div>
            </div>

            <div class="help-txt">
                <div class="hlp-txt-ttl">2</div>
                <div class="hlp-txt-dscrptn">إضغط على زر الحجز في قائمة الإنتظار أسفل صورة الطبيب كماهو مبين بالسهم</div>
            </div>

            <div class="help-txt">
                <div class="hlp-txt-ttl">3</div>
                <div class="hlp-txt-dscrptn">إضغط على الزر البرتقالي أعلى جدول  الحجوزات  لإظافة حجز جديد لنفسك</div>
            </div>

            <div class="help-txt">
                <div class="hlp-txt-ttl">4</div>
                <div class="hlp-txt-dscrptn">
                    <span>أدخل البيانات المطلوبة و إضغط على تأكيد الحجز و <span style="margin-right: 20mm;color: #94245F;">مبروك</span></span>
                </div>
            </div>
        </div>
        <img class="phones-help" src="{{ asset('poster/phones.svg') }}"  alt="">
    </div>

    <img class="arrow-red" src="{{ asset('poster/arrow.svg') }}" alt="">
</div>

<script>
    // Function to capture screenshot and save as PNG
    function captureScreenshot() {
      window.print();
    }

</script>
</body>
</html>
