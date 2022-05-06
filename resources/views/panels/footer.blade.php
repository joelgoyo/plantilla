<!-- BEGIN: Footer-->
<footer class="footer  footer-light {{($configData['footerType'] === 'footer-hidden') ? 'd-none':''}} {{$configData['footerType']}}">


  <div class="row justify-content-center textos">
    <div class="col-6">
      <span class="h1" style="color: #EBAAFF;letter-spacing: 5px;">
        EXCELSI<img src="{{asset('Dashboard/IMAGOEXCELESIOR-19/IMAGOEXCELESIOR-19.png')}}" width="50" alt="">R
      </span>
    </div>
    <div class="col-4 rosado fw-bold rights">
      © <script>
        document.write(new Date().getFullYear())
      </script> EXCELSIOR. All rights reserved.
    </div>
  </div>

</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>


<!-- END: Footer