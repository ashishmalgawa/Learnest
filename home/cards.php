<div class="panel panel-default">
  <div class="panel-body">
      <!--<button ng-click="showTab('first');" ng-show="btn||(flag!='first')">-->
          <img  class="img-responsive center-block" src="assets/img/year/first.png" alt="first year" ng-click="showTab('first');" ng-show="btn||(flag!='first')" role="button" align="center">

      <!--</button>-->
      
      <div ng-show="(flag==='first')&&tab" class="panel panel-primary">
          <!--<div class="alert alert-dismissible" role="alert">
              <button ng-click="btn=true" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
            
          <div class="panel-body">
              
          <ul class="nav nav-pills nav-stacked">
              
              <li role="presentation">
                  <a href="" ng-click="showSub(semester.id1)" target="_self">Semester 1</a>
              </li>
              <br>
              <li>
                  <a href="" ng-click="showSub(semester.id2)" target="_self">Semester 2</a>
              </li>
        </ul>
              
          </div>
          <!-- </div> -->
      </div>
    </div>
</div>


<div class="panel panel-default">
  <div class="panel-body">
<img  class="img-responsive center-block" src="assets/img/year/second.png" alt="second year" ng-click="showTab('second');" ng-show="btn||(flag!='second')" role="button">
      
      <div ng-show="(flag==='second')&&tab" class="panel panel-primary">
        <!--  <div class="alert alert-dismissible" role="alert">
              <button ng-click="btn=true" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            -->
          <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
              <li role="presentation">
                  <a href="" ng-click="showSub(semester.id3)" target="_self">Semester 3</a>
              </li>
              <li>
                  <a href=""  ng-click="showSub(semester.id4)" target="_self">Semester 4</a>
              </li>
        </ul>
          </div>
        <!--  </div> -->
      </div>
    </div>
</div>


<div class="panel panel-default">
  <div class="panel-body">
      <img  class="img-responsive center-block" src="assets/img/year/third.png" alt="third year" ng-click="showTab('third');" ng-show="btn||(flag!='third')" >

      <div ng-show="(flag==='third')&&tab" class="panel panel-primary">
        <!--  <div class="alert alert-dismissible" role="alert">
              <button ng-click="btn=true" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            -->
          <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
              <li role="presentation">
                  <a href="" ng-click="showSub(semester.id5)" target="_self">Semester 5</a>
              </li>
              <li>
                  <a href="" ng-click="showSub(semester.id6)" target="_self">Semester 6</a>
              </li>
        </ul>
          </div>
        <!--  </div> -->
      </div>
    </div>
</div>


<div class="panel panel-default">
  <div class="panel-body">
      <img  class="img-responsive center-block" src="assets/img/year/fourth.png" alt="fourth year" ng-click="showTab('fourth');" ng-show="btn||(flag!='fourth')" role="button">

      <div ng-show="(flag==='fourth')&&tab" class="panel panel-primary">
        <!--  <div class="alert alert-dismissible" role="alert">
              <button ng-click="btn=true" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            -->
          <div class="panel-body">
          <ul class="nav nav-pills nav-stacked">
              <li role="presentation">
                  <a href="" ng-click="showSub(semester.id7)" target="_self">Semester 7</a>
              </li>
              <li>
                  <a href="" ng-click="showSub(semester.id8)" target="_self">Semester 8</a>
              </li>
        </ul>
          </div>
        <!--  </div> -->
      </div>
    </div>
</div>
