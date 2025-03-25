

    <!-- Work with us -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <p class="fs-5 fw-medium text-primary">Work with us</p>
                    <h1 class="display-5 mb-4">Ready To Join Our Team?</h1>
                    <p>If you would like to collaborate with us or have any inquiries, we would be thrilled to hear from you! If you would like to collaborate with us or have any inquiries, we would be thrilled to hear from you!</p>
                    <p class="mb-4">We look forward to working together and providing you with the best service tailored to your needs. </p>
                    <a class="d-inline-flex align-items-center rounded overflow-hidden border border-primary" href="">
                        <span class="btn-lg-square bg-primary" style="width: 55px; height: 55px;">
                            <i class="fa fa-phone-alt text-white"></i>
                        </span>
                        <span class="fs-5 fw-medium mx-4">+254 746 552 659</span>
                    </a>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h2 class="mb-4">Work with us</h2>
                    <form id="workWithUsForm" method="POST" action="academy/workwithus.php" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="gname" name="fullname" placeholder="Your Name" required>
                                    <label for="name">Your Name</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="gmail" name="email" placeholder="Your Email" required>
                                    <label for="mail">Your Email</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="cname" name="phone_number"  placeholder="+254712345678" pattern="\+123\d{9}" title="please enter phone_number in the format +254712345678" required>
                                    <label for="mobile">Your Mobile</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="cage" name="country" placeholder="Country" required>
                                    <label for="cage">Country</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="app" name="application_type" placeholder="Application Type">
                                    <label for="mobile">Application Type</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control border-0" id="cv" name="cv" placeholder="CV">
                                    <label for="cage">Cv</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control border-0" id="letter" name="cover_letter" placeholder="Cover Letter">
                                    <label for="cage">Cover Letter</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message" style="height: 130px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn custom-color w-100 py-3" type="submit">Submit Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Quote Start -->