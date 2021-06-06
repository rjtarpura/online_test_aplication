<!-- start coded_template: id:6014869694 path:Coded files/Custom/email/enterprise/enterprise-nurture.html -->
<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width">
    <style type="text/css">
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        blockquote,
        ul,
        ol {
            margin: 0;
            padding: 0;
        }

        ul,
        ol {
            padding-left: 30px;
        }

        .ExternalClass,
        .ExternalClass div,
        .ExternalClass font,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass td,
        img {
            line-height: 100%
        }

        #outlook a {
            padding: 0
        }

        .ExternalClass,
        .ReadMsgBody {
            width: 100%
        }

        a,
        blockquote,
        body,
        li,
        p,
        table,
        td {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%
        }

        table,
        td {
            mso-table-lspace: 0;
            mso-table-rspace: 0;
        }

        img {
            -ms-interpolation-mode: bicubic;
            display: block;
            border: 0;
            outline: 0;
            text-decoration: none
        }

        #bodyCell,
        #bodyTable,
        body {
            height: 100% !important;
            margin: 0;
            padding: 0;
            width: 100% !important
        }

        table {
            border-collapse: collapse
        }

        span.preheader {
            display: none !important
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:100,200,300,500|Roboto:100,200,300,400,500,600,700');
    </style>
    <style type="text/css" id="hs-inline-css">
        body {
            font-family: 'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
            color: #4A4E57;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background: #ffffff;
            text-rendering: optimizeLegibility;
        }

        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        a {
            margin: 0;
            letter-spacing: 0.012em;
            word-break: break-word;
            word-wrap: break-word;
            color: #4A4E57
        }

        p a {
            color: #ffffff;
            text-decoration: none;
            border-bottom: 1px solid #661429;
        }

        td {
            color: #1F2532;
        }

        p,
        td {
            font-family: 'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
            font-size: 18px;
            color: #4A4E57;
            font-weight: 300;
            line-height: 1.77em;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
        }

        .cta a span {
            text-transform: uppercase;
            text-decoration: none;
            font-size: 13px;
            border-radius: 48px;
            border: 0;
            text-align: center;
            display: inline-block;
            padding: 24px 56px;
            width: auto;
            letter-spacing: 1px;
            background: $primary-color;
            color: #ffffff;
            line-height: 1em;
            font-weight: 300;
        }

        .cta a {
            text-decoration: none;
        }

        .ctabtn {
            width: 100%;
        }

        .ctabtn td {
            color: #ffffff;
            text-decoration: none;
            background: $primary-color;
            padding: 24px;
            text-align: center;
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 500;
            letter-spacing: 0.05px;
            line-height: 1em;
            border-radius: 48px;
            box-shadow: 0px 20px 70px 0px rgba(0, 0, 0, 0.2);
        }

        .ctabtn td a {
            color: #ffffff;
            text-decoration: none;
            border: 0;
            letter-spacing: .05em;
        }

        .preheader,
        span[summary="preheader"] {
            display: none !important;
            margin-left: -9999 !important;
            width: 0 !important;
            height: 0 !important;
            visibility: hidden !important;
            min-width: 0 !important;
            min-height: 0 !important;
            font-size: 0 !important;
            line-height: 0 !important;
        }

        .spacer {
            font-size: 1px;
            height: 0;
        }

        .text-alignright {
            text-align: right;
        }

        .text-alignleft {
            text-align: left;
        }

        .emailbody {
            width: 100%;
            max-width: 680px;
            text-align: center;
        }

        .emailbody .spacer.bot {
            height: 40px;
        }

        .masthead {
            width: 100%;
            border-bottom: 1px solid #E2E2E6;
        }

        .masthead .spacer.v.top {
            height: 22px;
        }

        .masthead .spacer.v.bot {
            height: 28px;
        }

        .mastheadlinks {
            width: 100%;
            max-width: 760px;
            text-align: center;
        }

        .mastheadlinks a {
            font-size: 12px;
            font-weight: 500;
            color: #9FA1A7;
            text-decoration: none;
            border-bottom: 1px solid;
            letter-spacing: .5px;
            line-height: 1em;
            padding-bottom: 6px;
        }

        .logo {
            width: 100%;
            text-align: center;
        }

        .logo .spacer {
            height: 90px;
        }

        .intro {
            width: 100%;
            text-align: center;
        }

        .intro h1 {
            font-size: 48px;
            font-weight: 200;
            line-height: 1.4em;
        }

        .intro h2 {
            font-size: 36px;
            font-weight: 200;
            line-height: 1.4em;
        }

        .intro p a,
        .intro a {
            color: $primary-color;
            text-decoration: none;
            border-bottom: 1px solid;
        }

        .introtext {
            width: 100%;
            max-width: 580px;
            text-align: center;
        }

        .intro .cta table {
            width: auto;
        }

        .intro .cta table a {
            padding: 0 24px;
        }

        .intro .spacer.cta {
            height: 50px;
        }

        .intro .spacer.img.top {
            height: 60px;
        }

        .intro .spacer.message {
            height: 20px;
        }

        .intro .spacer.bot {
            height: 40px;
        }

        .intro .spacer.topline {
            height: 72px;
        }

        .intro .spacer.line {
            height: 1px;
            border-bottom: 1px solid #E2E2E6;
        }

        .presenters {
            max-width: 680px;
            width: 100%;
            text-align: center;
        }

        .presenters th {
            width: 25%;
            text-align: center;
            vertical-align: top;
        }

        .presenters h3 {
            font-size: 16px;
            margin-bottom: 8px;
            line-height: 1em;
        }

        .presenters h4 {
            font-size: 16px;
            font-weight: 200;
            line-height: 1em;
        }

        .presenters img {
            margin-bottom: 16px;
        }

        .presenters .spacer.v {
            height: 65px;
        }

        .presenters .mobilebreak {
            width: 0;
        }

        .contentblock {
            width: 100%;
            max-width: 580px;
            text-align: center;
        }

        .contentblock .message {
            text-align: left;
            font-size: 18px;
        }

        .contentblock h2 {
            font-size: 20px;
            font-weight: 300;
            margin-bottom: 30px;
        }

        .contentblock p {
            margin-bottom: 30px;
        }

        .contentblock ul,
        .contentblock ol {
            margin-left: 20px;
            margin-bottom: 30px;
        }

        .contentblock ul {
            list-style: square;
        }

        .contentblock li {
            list-style: square;
        }

        .contentblock strong {
            font-weight: 500;
        }

        .contentblock a {
            color: $primary-color;
            border-bottom: 1px solid;
            text-decoration: none;
        }

        .contentblock a {
            color: $primary-color;
            border-bottom: 1px solid;
            text-decoration: none;
        }

        .contentblock .cta table {
            width: auto;
        }

        .contentblock .cta table a {
            padding: 0 24px;
        }

        .contentblock .spacer.cta {
            height: 60px;
        }

        .companylogos {
            width: 100%;
            text-align: center;
        }

        .companylogos p {
            text-align: center;
            font-size: 12px;
            color: #9FA1A7;
            letter-spacing: .5px;
            line-height: 1em;
        }

        .logoimgs {
            text-align: center;
        }

        .logoimgs img {
            display: inline-block;
        }

        .companylogos .spacer {
            height: 40px;
        }

        .share {
            width: 100%;
            text-align: center;
        }

        .share .line {
            height: 1px;
            background: #E2E2E6;
            font-size: 0;
            line-height: 1px;
        }

        .share .spacer.v {
            height: 50px;
        }

        .share h2 {
            text-align: center;
            font-weight: 300;
            font-size: 18px;
            font-family: 'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
        }

        .shareicons {
            width: 100%;
            max-width: 380px;
            text-align: center;
        }

        .shareicons td {
            width: 60px;
            text-align: center;
        }

        .shareicons a {
            font-size: 10px;
            font-weight: 700;
            text-decoration: none;
        }

        .shareicons .spacer.h {
            width: 100px;
        }

        .shareicons .spacer.v {
            height: 50px;
        }

        .shareicons .spacer.bot {
            height: 30px;
        }

        .closing {
            width: 300px;
            text-align: center;
        }

        .closing h3 {
            font-size: 14px;
            font-weight: 300;
            line-height: 1.7em;
            font-family: 'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
        }

        .closing a {
            font-size: 14px;
            font-weight: 300;
            text-decoration: none;
            border-bottom: 1px solid;
            color: $primary-color;
        }

        .closing .spacer.link {
            height: 10px;
        }

        .contenttiles {
            width: 100%;
        }

        .contenttiles .line {
            height: 1px;
            background: #E2E2E6;
            font-size: 0;
            line-height: 1px;
        }

        .contenttiles .title {
            padding-left: 60px;
            text-align: left;
        }

        .contenttiles .title.center {
            padding-left: 0;
            text-align: center;
        }

        .contenttiles .title h1 {
            font-size: 28px;
            line-height: 1em;
            font-weight: 200;
        }

        .contenttiles .spacer.title.top {
            height: 40px;
        }

        .contenttiles .spacer.title.bot {
            height: 40px;
        }

        .contenttiles .spacer.notitle.top {
            height: 30px;
        }

        .contenttiles.fulltop .spacer.pic,
        .contenttiles.fullbot .spacer.pic {
            height: 70px;
        }

        .contenttiles.fulltop h2,
        .contenttiles.fullbot h2 {
            font-size: 36px;
            font-weight: 200;
            line-height: 1.44em;
        }

        .contenttiles.fulltop .text,
        .contenttiles.fullbot .text {
            width: 100%;
            max-width: 480px;
            text-align: center;
            display: block;
        }

        .contenttiles.fulltop .divider,
        .contenttiles.fullbot .divider {
            width: 100%;
            max-width: 580px;
            text-align: center;
        }

        .contenttiles .divider .line {
            height: 1px;
            background: #E2E2E6;
            font-size: 0;
            line-height: 1px;
        }

        .contenttiles .divider .spacer.top {
            height: 80px;
        }

        .contenttiles.fulltop .spacer.header,
        .contenttiles.fullbot .spacer.header {
            height: 25px;
        }

        .contenttiles a {
            color: $primary-color;
            text-decoration: none;
            border-bottom: 2px solid;
            font-size: 12px;
            font-weight: 700;
            padding-bottom: 6px;
            letter-spacing: 1px;
        }

        .contenttiles p a {
            color: $primary-color;
            text-decoration: none;
            border-bottom: 1px solid;
            font-size: 16px;
            font-weight: 400;
            padding-bottom: 2px;
            letter-spacing: 0;
        }

        .contenttiles.x2square th,
        .contenttiles.x2rectangle th,
        .contenttiles.stacked th {
            width: 300px;
            text-align: left;
            vertical-align: top;
        }

        .contenttiles.x2square .spacer.h,
        .contenttiles.x2rectangle .spacer.h {
            width: 80px;
        }

        .contenttiles.x2square img,
        .contenttiles.x2rectangle img {
            margin-bottom: 40px;
        }

        .contenttiles.x2square h2,
        .contenttiles.x2rectangle h2,
        .contenttiles.stacked h2 {
            font-size: 20px;
            font-weight: 300;
            line-height: 1.6em;
            margin-bottom: 15px;
        }

        .contenttiles.x2square p,
        .contenttiles.x2rectangle p,
        .contenttiles.stacked p {
            font-size: 16px;
            font-weight: 300;
            line-height: 1.75em;
            margin-bottom: 20px;
        }

        .contenttiles.x2square .spacer.v,
        .contenttiles.x2rectangle .spacer.v {
            height: 80px;
        }

        .contenttiles.x2rectangle p,
        .contenttiles.x2rectangle h2 {
            margin-left: 0;
        }

        .contenttiles .flow {
            width: 100%;
        }

        .contenttiles .flow.mobile {
            display: none;
        }

        .contenttiles .flow th {
            vertical-align: top;
            text-align: left;
        }

        .contenttiles .flow .pic {
            width: 300px;
        }

        .contenttiles .flow .spacer.h {
            width: 40px;
        }

        .contenttiles .flow .text {
            width: 100%;
            max-width: 340px;
            display: block;
        }

        .contenttiles .flow h2 {
            margin: 0;
            font-size: 20px;
            line-height: 1.4em;
            margin-bottom: 15px;
            font-weight: 300;
        }

        .contenttiles .flow p {
            font-size: 16px;
            line-height: 1.75em;
            margin-bottom: 20px;
        }

        .contenttiles .spacer.flow.v {
            height: 60px;
        }

        .contenttiles a img {
            border: 0 !important;
            padding-bottom: 0 !important;
        }

        .contenttiles.stacked .spacer.h {
            height: 20px;
            width: 40px;
        }

        .contenttiles.stacked .spacer.v {
            height: 60px;
        }

        .contenttiles.center .spacer.v.v {
            height: 40px;
        }

        .contenttiles.stacked_icons h1 {
            font-size: 24px;
            line-height: 1.4em;
        }

        .contenttiles.stacked_icons {
            max-width: 600px;
            margin: auto;
        }

        .contenttiles.stacked_icons th {
            vertical-align: top;
            text-align: left;
        }

        .contenttiles.stacked_icons .spacer.h {
            height: 20px;
            width: 40px;
        }

        .contenttiles.stacked_icons p {
            line-height: 1.4em;
        }

        .relatedresourcesbreak {
            width: 100%;
        }

        .relatedresourcesbreak .spacer.line {
            height: 1px;
            background: #D2D3D4;
        }

        .relatedresources {
            max-width: 400px;
        }

        .relatedresources h2 {
            font-family: 'Poppins', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
            font-size: 28px;
            font-weight: 200;
            text-align: center;
            color: #4a4e57;
        }

        .relatedresourcestiles {
            margin-top: 40px;
            max-width: 480px;
        }

        .relatedresourcestiles th {
            text-align: left;
            width: 200px;
            vertical-align: top;
        }

        .relatedresourcestiles h3 {
            font-family: 'Poppins', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
            font-size: 20px;
            font-weight: 300;
            margin: 1em 0 .4em;
            color: #4a4e57;
        }

        .relatedresourcestiles p {
            font-size: 14px;
            font-weight: 300;
            text-align: left;
            margin: 1em 0;
        }

        .relatedresourcestiles img {
            box-shadow: 0px 2px 20px 0px rgba(0, 0, 0, 0.1);
            width: 100%;
            height: auto;
        }

        .relatedresourcestiles a {
            color: $primary-color;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .5px;
            border-bottom: 1px solid;
            padding-bottom: 2px;
        }

        .relatedresourcestiles .spacer.v {
            height: 40px;
        }

        .relatedresourcestiles .spacer.h {
            width: 80px;
        }

        .relatedresourcestiles .line {
            height: 1px;
            border-bottom: 1px solid #E2E2E6;
        }

        .footer {
            width: 100%;
            max-width: 680px;
            background: #F8F8F9;
            text-align: center;
        }

        .footer .spacer.h {
            width: 45px;
        }

        .footer .spacer.v {
            height: 90px;
        }

        .footer .spacer.logo {
            height: 50px;
        }

        .footercontent {
            width: 100%;
        }

        .footer h2 {
            font-size: 26px;
            font-weight: 200;
            line-height: 1.66em;
            text-align: center;
        }

        .footer h3 {
            font-size: 14px;
            font-family: 'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif;
            text-align: center;
            font-weight: 400;
            color: #737881;
        }

        .footer .address {
            font-size: 14px;
            color: #737881;
            font-weight: 300;
            text-align: center;
        }

        .footer .links {
            width: 100%
        }

        .footer .links td {
            text-align: center;
        }

        .footer .links a {
            font-size: 10px !important;
            text-decoration: none !important;
            border-bottom: 1px solid;
            color: #9FA1A7 !important;
            font-weight: 700 !important;
            line-height: 24px !important;
            display: inline-block;
        }

        .footer .links .spacerline {
            vertical-align: bottom;
            display: inline-block;
        }

        .footer .socialmedia {
            text-align: center;
        }

        .footer .socialmedia .spacer {
            width: 32px;
            height: 30px;
        }

        .footer .socialmedia .spacer.bot {
            height: 70px;
        }

        .footer .socialmedia .spacer.top {
            height: 50px;
        }
    </style>
    <style type="text/css" id="no-inline-css">
        @media screen and (max-width: 9999px) {
            .contenttiles.stacked th {
                display: table-cell !important;
            }

            .contenttiles.stacked .spacer.v {
                height: 30px !important;
            }

            .contenttiles.stacked .spacer.h {
                width: 40px !important;
            }

            .contenttiles.stacked .description {
                width: 340px !important;
            }
        }

        @media screen and (max-width:779px) {
            .mastheadlinks {
                width: 90% !important;
            }
        }

        @media screen and (max-width:670px) {

            .intro h2 {
                font-size: 28px !important;
                margin: 0 !important;
            }

            .footer h2 {
                font-size: 22px !important;
            }

            .footer .spacer.h {
                width: 20px !important;
            }

            .footer .spacer.logo {
                height: 40px !important;
            }

            .footer {
                width: 100% !important;
            }

            .emailbody {
                width: 90% !important;
            }

            .intro img {
                width: 100% !important;
            }

            .contenttiles.stagger {
                width: 100% !important;
            }

            .contenttiles .title {
                padding: 0 !important;
                text-align: center !important;
            }

            .contenttiles.x2square th,
            .contenttiles.x2rectangle th {
                display: block !important;
                margin: auto !important;
            }

            .contenttiles.x2rectangle p,
            .contenttiles.x2rectangle h2 {
                margin-left: 0 !important;
            }

            .contenttiles.x2square img,
            .contenttiles.x2rectangle img {
                margin-bottom: 20px !important;
            }

            .contenttiles.x2square .spacer.h,
            .contenttiles.x2rectangle .spacer.h {
                height: 30px !important;
            }

            .contenttiles.stacked {
                width: 100% !important;
            }

            .contenttiles.stacked th {
                display: block !important;
                margin: auto !important;
            }

            .presenters th {
                display: block !important;
                width: 50% !important;
                float: left;
            }

            .presenters .mobilebreak {
                display: block !important;
                height: 60px;
                width: 100% !important;
                clear: both;
                float: none !important;
            }

            .presenters img {
                width: 100px !important;
            }

            .presenters .spacer.v.bot {
                display: none !important;
            }

            .relatedresourcestiles th {
                display: block !important;
                margin: auto !important;
                width: 300px !important;
            }

            .relatedresourcestiles .spacer.h {
                height: 30px !important;
            }
        }
    </style>
    <style type="text/css" id="no-inline-css">
        @media screen and (max-width:579px) {
            .introtext {
                width: 100% !important;
            }
        }

        @media screen and (max-width:549px) {

            .contenttiles.fulltop .divider,
            .contenttiles.fullbot .divider {
                width: 100% !important;
            }
        }

        @media screen and (max-width:549px) {

            p,
            td {
                font-size: 16px !important;
            }

            .ctabtn td {
                font-size: 11px !important;
            }

            .logo .spacer {
                height: 30px !important;
            }

            .intro .spacer.img.top {
                height: 40px !important;
            }

            .flow.desktop {
                display: none !important;
            }

            .flow.mobile {
                display: block !important;
                width: 300px !important;
                text-align: center !important;
                margin: auto !important;
            }

            .flow.mobile th {
                display: block !important;
            }

            .flow.mobile .spacer.h {
                height: 20px !important;
            }

            .contenttiles .spacer.flow.v {
                height: 30px !important;
            }

            .contenttiles .flow .text {
                width: 100% !important;
            }

            .contenttiles.stacked {
                width: 100% !important;
            }

            .contenttiles.stacked th {
                display: block !important;
                margin: auto !important;
            }

            .contenttiles.stacked .description {
                width: 300px !important;
            }

            .contenttiles.stacked .spacer.h {
                height: 20px !important;
            }

            .contentblock {
                width: 100% !important;
            }

            .shareicons {
                width: 260px !important;
            }

            .shareicons .spacer.h {
                width: 40px !important;
            }

            .share .spacer.v {
                height: 30px !important;
            }
        }
    </style>
    <style type="text/css" id="no-inline-css">
        @media screen and (max-width:479px) {

            .contenttiles.fulltop .text,
            .contenttiles.fullbot .text {
                width: 90% !important;
            }

            .header {
                width: 90% !important;
            }

            .intro h1,
            .intro-header h1,
            .featuresintro h1,
            .closing h1 {
                font-size: 36px !important;
            }

            .intro,
            .closing {
                width: 100% !important;
            }

            .footer .address {
                font-size: 14px !important;
            }
        }

        @media screen and (max-width:340px) {

            .intro p,
            .closing p {
                font-size: 16px !important;
            }

            .footer .spacer.h {
                display: none !important;
            }
        }
    </style>
    <meta name="generator" content="HubSpot">
    <meta name="x-apple-disable-message-reformatting">
    <meta name="robots" content="noindex,follow">
</head>

<body bgcolor="#ffffff" style="font-family:'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif; color:#4a4e57; height:100% !important; margin:0 !important; padding:0 !important; width:100% !important; background:#ffffff; text-rendering:optimizeLegibility">
    <div id="preview_text" style="display:none;font-size:1px;color:#f2f2f2;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;"> @yield('mailPreviewText', config('app.name', 'Laravel') . ' notification email')</div>

    @include('emails.include.header')
    @include('emails.include.logo-content')

        <table cellspacing="0" cellpadding="0" class="emailbody"
            style="width:100%; max-width:680px; text-align:center" width="100%" align="center">
            <tbody>
              <tr>
                <td
                  style="font-family:'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif; font-size:18px; color:#4a4e57; font-weight:300; line-height:1.77em">
                  <div id="hs_cos_wrapper_module_153288869204185"
                    class="hs_cos_wrapper hs_cos_wrapper_widget hs_cos_wrapper_type_module"
                    style="color: inherit; font-size: inherit; line-height: inherit;" data-hs-cos-general-type="widget"
                    data-hs-cos-type="module">
                        <table cellspacing="0" cellpadding="0" class="intro" style="width:100%; text-align:center" width="100%" align="center">
                            <tr>
                                <td
                                style="font-family:'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif; font-size:18px; color:#4a4e57; font-weight:300; line-height:1.77em">
                                <table cellspacing="0" cellpadding="0" class="introtext"
                                    style="width:100%; max-width:580px; text-align:left" width="100%" align="center">
                                    <tbody>
                                    <tr>
                                        <td
                                        style="font-family:'Roboto', BlinkMacSystemFont, Helvetica, Arial, sans-serif; font-size:18px; color:#4a4e57; font-weight:300; line-height:1.77em">
                                            {{-- Main Content --}}
                                            @yield('content')
                                            {{-- A dirty patch to avoid additional spaces for the email templates--}}
                                            @yield('additionalSpace', \View::make('emails.include.empty-spacer'))
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                </td>
                            </tr>
                        </table>
                  </div>
                </td>
              </tr>
            </tbody>
        </table>
    @include('emails.include.footer')
</body>
</html>