<div class="row">
  <div class="col-xs-12 col-sm-4">
    <div class="phone-images">
      <img ng-src="{{mainImageUrl}}">
    </div>
    <ul class="phone-thumbs list-unstyled">
      <li ng-repeat="img in phone.images">
        <img ng-src="{{img}}" ng-click="setImage(img)">
      </li>
    </ul>
  </div>
  <div class="col-xs-12 col-sm-8">
    <h1>{{phone.name}}</h1>
    <p>{{phone.description}}</p>
    <hr>
    <ul class="specs list-unstyled">
      <li>
        <span>Availability and Networks</span>
        <dl>
          <dt>Availability</dt>
          <dd ng-repeat="availability in phone.availability">{{availability}}</dd>
        </dl>
      </li>
      <li>
        <span>Battery</span>
        <dl>
          <dt>Type</dt>
          <dd>{{phone.battery.type}}</dd>
          <dt>Talk Time</dt>
          <dd>{{phone.battery.talkTime}}</dd>
          <dt>Standby time (max)</dt>
          <dd>{{phone.battery.standbyTime}}</dd>
        </dl>
      </li>
      <li>
        <span>Storage and Memory</span>
        <dl>
          <dt>RAM</dt>
          <dd>{{phone.storage.ram}}</dd>
          <dt>Internal Storage</dt>
          <dd>{{phone.storage.flash}}</dd>
        </dl>
      </li>
      <li>
        <span>Connectivity</span>
        <dl>
          <dt>Network Support</dt>
          <dd>{{phone.connectivity.cell}}</dd>
          <dt>WiFi</dt>
          <dd>{{phone.connectivity.wifi}}</dd>
          <dt>Bluetooth</dt>
          <dd>{{phone.connectivity.bluetooth}}</dd>
          <dt>Infrared</dt>
          <dd>{{phone.connectivity.infrared | checkmark}}</dd>
          <dt>GPS</dt>
          <dd>{{phone.connectivity.gps | checkmark}}</dd>
        </dl>
      </li>
      <li>
        <span>Android</span>
        <dl>
          <dt>OS Version</dt>
          <dd>{{phone.android.os}}</dd>
          <dt>UI</dt>
          <dd>{{phone.android.ui}}</dd>
        </dl>
      </li>
      <li>
        <span>Size and Weight</span>
        <dl>
          <dt>Dimensions</dt>
          <dd ng-repeat="dim in phone.sizeAndWeight.dimensions">{{dim}}</dd>
          <dt>Weight</dt>
          <dd>{{phone.sizeAndWeight.weight}}</dd>
        </dl>
      </li>
      <li>
        <span>Display</span>
        <dl>
          <dt>Screen size</dt>
          <dd>{{phone.display.screenSize}}</dd>
          <dt>Screen resolution</dt>
          <dd>{{phone.display.screenResolution}}</dd>
          <dt>Touch screen</dt>
          <dd>{{phone.display.touchScreen | checkmark}}</dd>
        </dl>
      </li>
      <li>
        <span>Hardware</span>
        <dl>
          <dt>CPU</dt>
          <dd>{{phone.hardware.cpu}}</dd>
          <dt>USB</dt>
          <dd>{{phone.hardware.usb}}</dd>
          <dt>Audio / headphone jack</dt>
          <dd>{{phone.hardware.audioJack}}</dd>
          <dt>FM Radio</dt>
          <dd>{{phone.hardware.fmRadio | checkmark}}</dd>
          <dt>Accelerometer</dt>
          <dd>{{phone.hardware.accelerometer | checkmark}}</dd>
        </dl>
      </li>
      <li>
        <span>Camera</span>
        <dl>
          <dt>Primary</dt>
          <dd>{{phone.camera.primary}}</dd>
          <dt>Features</dt>
          <dd>{{phone.camera.features.join(', ')}}</dd>
        </dl>
      </li>
      <li>
        <span>Additional Features</span>
        <dd>{{phone.additionalFeatures}}</dd>
      </li>
    </ul>
  </div>
</div>