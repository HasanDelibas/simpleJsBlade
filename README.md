# simpleJsBlade
Laravel blade for JS

# Blade Syntax: data
    data
data is parent data values. You can use with data echo any variable.
## Example
Input :test.blade.html

    <h1>{{ data.name }} </h1>
    <p>{{ data.description }} </p>

complier

    <?php
        include 'bladeComplier.php';
        // bladeComplier::complie( BLADE_FILE ,  JS_FILE , JS_FUNCTION_NAME );
        bladeComplier::complie('test.blade.html','test.js', 'test');

JS Output :test.js

    test = function(data){
    var retVal =`    <h1>`;
     retVal +=  data.name  ;
     retVal +=` </h1>
        <p>`;
     retVal +=  data.description  ;
     retVal +=` </p>`;
    return retVal;}
    
Using in Js Example:

    var data = {name :'Hasan Delibaş' , description: 'This is for js blade example.'};
    document.getElementsByTagName('body')[0].innerHtml = test(data);

HMTL Output :
    
    <h1> Hasan Delibaş </h1>
    <p> This is for js blade example. </p>
    

# Blade Syntax : foreach

    {{ @foreach(data as d) }}

foreach all js data using this can be object or array.

Example
    
    // arrayexample.blade.html
    
    <ul>
      {{ @foreach(data.arrays as a) }}
      {{ @begin }}
      <li> {{ a }} </li>
      {{ @end }}
    </ul>

    //IN PHP
    
    bladeComplier::complie('arrayexample.blade.html','arrayexample.js','arrarExample');
    
    // IN JS
    var data = { arrays : [1,2,3,4,5,11,2] };
    console.log (  arrayExample ( data ) ) ;
    
    // JS CONSOLE OUTPUT
    
    <ul>
      <li> 1 </li>
      <li> 2 </li>
      <li> 3 </li>
      <li> 4 </li>
      <li> 5 </li>
      <li> 11 </li>
      <li> 2 </li>
    </ul>
    
    
    
I hope heplfull....
