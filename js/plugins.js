
// usage: log('inside coolFunc', this, arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
/*
window.log = function(){
    log.history = log.history || [];   // store logs to an array for reference
    log.history.push(arguments);
    if(this.console) {
        arguments.callee = arguments.callee.caller;

        var newarr = [].slice.call(arguments);
        if(typeof console.log === 'object') log.apply.call(console.log, console, newarr);
        else {
            
            console.log.apply(console, newarr);
        }
    }
};
*/

window.log = function(msg) {
    log.history = log.history || [];
    log.history.push(arguments);
    $.post('jx/do.php',{action:"log", type:"ajax", msg: msg});
    console.log(msg);
};

// make it safe to use console.log always
(function(b){function c(){}for(var d="assert,clear,count,debug,dir,dirxml,error,exception,firebug,group,groupCollapsed,groupEnd,info,log,memoryProfile,memoryProfileEnd,profile,profileEnd,table,time,timeEnd,timeStamp,trace,warn".split(","),a;a=d.pop();){b[a]=b[a]||c}})((function(){try
{console.log();return window.console;}catch(err){return window.console={};}})());


// place any jQuery/helper plugins in here, instead of separate, slower script files. 

