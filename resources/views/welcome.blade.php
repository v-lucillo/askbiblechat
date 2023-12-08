@extends('layout.main')
@section('style')
    <style>
        @keyframes float {
            0% {
                transform: translatey(0px);
                transform: translatex(-20px);
            }
            50% {
                transform: translatey(-20px);
                transform: translatex(30px);
            }
            100% {
                transform: translatey(0px);
                transform: translatex(-20px);
            }
        }

        .avatar {
            overflow: hidden;
            transform: translatey(0px);
            transform: translatex(-20px);
            animation: float 3s ease-in-out infinite;
        }

        #hero_input{
            width: 100%;
            height: 50px;
            font-size: 35px;
            padding: 19px;
            margin: 15px 0px;
            outline: 0;
            border-width: 0px 0 1px;
        }

    </style>
@endsection
@section('content')
<header class="py-3" id = "home">
        <div class="container px-5 pb-5">
            <div class="row gx-5">
                <div class="col-xxl-5">
                    <div style="text-align: left;">
                        <div>
                            <h1>AI BIBILE TOOL</h1>
                            <span>New International Version (NIV)</span>
                        </div>
                        <img class = "avatar" src="{{asset('askbible/img/b1.png')}}" alt="" style="margin-top: 30px;
                        margin-left: -65px; margin-bottom: 10px">

                        <div style="margin-top: -3em;">
                            <button name = "try_it_now_button" style="border-color: #1967d2;
                            color: #1967d2;
                            background-color: #FFFF;
                            width: 324px;
                            height: 74px;
                            outline: 0;
                            border-width: 0px 0 1px;
                            font-size: 37px;
                            display: none;"> Try it now!</button>
                        </div>


                    </div>
                </div>
                <div class="col-xxl-7">
                    <input type="text"  id = "hero_input" placeholder="Ask question to AskBible. . .">
                    <h1 style="font-size: 60px" id = "hero"></h1>
                </div>
            </div>
        </div>
</header>


<!-- About Section-->
<section class="bg-primary py-10" id = "about">
    <div class="container px-5">
        <div class="row gx-5 justify-content-center">
            <div class="col-xxl-8">
                <div class="my-5">
                    <h1 style="font-size: 50px;">About</h1>
                    <p style="font-size: 30px;">We think this will be very useful for Bible Study students, young people learning the Bible, Churches, home use daily or whenever you have a question about Bible events and verses.</p>
                    <p style="font-size: 30px;">For authors, Bible commentary creators, Bible Seminaries, Colleges, it is also possible for us to help you create solutions like this by adding your unique content to your own application, and branded to your organization.</p>
                    <p style="font-size: 30px;">If you would like to explore this, please fill in the form below and let’s have a discussion and explore the possibilities!</p>
                    <p style="font-size: 30px;">Let’s embrace technology together to spread the Gospel!</p>
                </div>
            </div>
            <div class="col-xxl-4">
                <div class="my-5">
                    <h1 style="font-size: 30px;color: #1967d2">Did you try it and do you like it?</h1>
                    <p style="font-size: 20px;">Please help us develop it further, add more translations and options by donating.</p>
                    <hr>
                    <h1 style="font-size: 30px;color: #1967d2">Want to be a regular user?</h1>
                    <p style="font-size: 20px;"> Great! then Subscribe for only <span style="font-size: 30px;text-decoration: underline;">$3 per month!</span></p>
                    <hr>
                    <h1 style="font-size: 30px;color: #1967d2">What other translations of the Bible would you like to see?</h1>
                    <p style="font-size: 20px;">Please give us your feedback. I'm really interested. Click here to leave comments!</p>
                    <hr>
                    <h1 style="font-size: 30px;color: #1967d2">Are you a church or organization that would like an option like this integrated with your website or mobile app?</h1>
                    <p style="font-size: 20px;">Click here to send us a message with your requirements and contact details</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-5" id = "contact">
    <div class="container px-5">
        <div class="bg-light rounded-4 py-5 px-4 px-md-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient-primary-to-secondary text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                <h1 class="fw-bolder">Get in touch</h1>
                <h3>How can we help?</h3>
                <p class="lead fw-normal text-muted mb-0">Let's work together!</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                            <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback" data-sb-feedback="phone:required">A phone number is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                        </div>

                        <div class="d-none" id="submitSuccessMessage">
                            <div class="text-center mb-3">
                                <div class="fw-bolder">Form submission successful!</div>
                                To activate this form, sign up at
                                <br />
                                <a href="#">https://startbootstrap.com/solution/contact-forms</a>
                            </div>
                        </div>
                        <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                        
                        <div class="d-grid"><button class="btn btn-primary btn-lg" id="submitButton" type="submit">SEND MESSAGE</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')
<script>
    var hero_input = document.getElementById('hero_input')
    var customNodeCreator = function(character) {
        // Add character to input placeholder
        hero_input.value = hero_input.value + character;
        // hero_input.value = "";
        // Return null to skip internal adding of dom node
        return null;
    }
    var onRemoveNode = function({ character }) {
        if(hero_input.value) {
            // Remove last character from input placeholder
            hero_input.value = "";
        }
    }

    var hero_input_typewriter = new Typewriter(null, {
        loop: false,
        delay: 50,
        onCreateTextNode: customNodeCreator,
        onRemoveNode: onRemoveNode,
    });

    hero_input_typewriter
        .pauseFor(1000)
        .typeString('How to use the application?')
        .start()
        .pauseFor(17000);




    new Typewriter(document.getElementById('hero'), {
            loop: false,
            delay: 50,
        }).pauseFor(4000)
        .typeString('Use this AI to ask questions about the Bible.')
        .pauseFor(900)
        .typeString('You can find verses, Bible facts.')
        .pauseFor(900)
        .typeString('<br>You can ask about <strong>Bible events</strong> and find where these are mentioned in the Bible. - ')
        .pauseFor(700)
        .typeString('<small style = "font-size: 45px"><i> AI Bible</i></small>')
        .callFunction(() => {
            console.log("I am here!");
            $('button[name="try_it_now_button"]').fadeIn( "slow" );
        })
        .start();
</script>
@endsection