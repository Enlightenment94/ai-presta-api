function cut(testStr, startStr, endStr, enter){
    var result = "";

    var correct = 0;
    var i,j;

    var start = -1;
    var end = -1;
    for(i = enter; i < testStr.length; i++){
        if(testStr[i] == startStr[j]){
            if(correct == startStr.length - 1){
                start = i - startStr.length + 1;
                end = i + 1;
                break;                
            }
            correct++;
            j++;
        }else{
            correct = 0;        
            j = 0;
        }
    }

    //console.log(testStr.substring(start, end));

    var startEndStr = -1;
    var endEndStr = -1;
    j = 0;
    for(i = end; i < testStr.length; i++){
        if(testStr[i] == endStr[j]){
            if(correct == endStr.length - 1){
                startEndStr = i - endStr.length + 1;
                endEndStr = i + 1;
                //console.log(start + " " + end);
                break;                
            }
            correct++;
            j++;
        }else{
            correct = 0;        
            j = 0;
        }
    }

    //console.log(testStr.substring(startEndStr, endEndStr));
    return Array(start, end, startEndStr, endEndStr, i);
}

function cutAll(testStr, startStr, endStr){
    var k = 0;
    var arr;
    var enter = 0;
    var resultArr = new Array();
    var z = 0;
    for(k = 0; k < testStr.length; k++){
        arr = cut(testStr, startStr, endStr , enter);
        //console.log(arr[0]);
        //console.log(arr[1]);
        //console.log(arr[2]);
        //console.log(arr[3]);
        //console.log(arr[4]);
        enter = arr[4];
        //console.log("next");
        if(arr[0] == -1 || arr[2] == -1 ){
            break;
        }
        resultArr[z] = testStr.substring(arr[1], arr[2]);
        z++;
    }
    return resultArr;
}