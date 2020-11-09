<!-- Slideshow container -->
<div class="slideshow-container container">

    <!-- Full-width images with number and caption text -->
    <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <img src="{{ asset('storage/images/slides/4.jpg') }}" style="width:100%">
        <div class="text">
            <h3>
                وزارت صنعت و معدن
            </h3>
            <a href="{{ asset('storage/pdf/1.pdf') }}" class="btn bg-light text-primary">
                بخشنــامه شــماره یــک
            </a>
        </div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <img src="{{ asset('storage/images/slides/2.jpg') }}" style="width:100%">
        <div class="text"><h3>
                وزارت صنعت و معدن
            </h3>
            <a href="{{ asset('storage/pdf/1.pdf') }}" class="btn bg-light text-primary">
                بخشنــامه شــماره 12356
            </a></div>
    </div>

    <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <img src="{{ asset('storage/images/slides/3.jpg') }}" style="width:100%">
        <div class="text"><h3>
                وزارت صنعت و معدن
            </h3>
            <a href="{{ asset('storage/pdf/1.pdf') }}" class="btn bg-light text-primary">
                بخشنــامه شــماره 4/5/5
            </a></div>
    </div>

    <!-- Next and previous buttons
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>-->
</div>
<br>

<!-- The dots/circles
<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>
-->

<script>
    var slideIndex = 0;
    showSlides();

    function showSlides() {
        var i;
        var slides = document.getElementsByClassName("mySlides");
        setTimeout(5, function() {})

            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";

            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            slides[slideIndex - 1].style.display = "block";
            setTimeout(showSlides, 5000); // Change image every 2 seconds
        }


</script>
