$(document).ready(function() {
    // $('.popup-box').magnificPopup({
    //     // type: 'iframe',
    //     // overflowY: 'scroll'
    //     disableOn: 700,
    //     type: 'iframe',
    //         // mainClass: 'mfp-fade',
    //     removalDelay: 160,
    //     preloader: false,

    //     fixedContentPos: false
    // });


    $(".popup-box").click(function(evt) {
        // This stops the form submission.
        evt.preventDefault();


    // Carry on with your code here.
    });
});


// App.directive('toolbarTip', function() {
//     return {
//         restrict: 'A',
//         link: function(scope, element, attrs) {
//             $(element).magnificPopup({
//                 // type: 'iframe',
//                 // overflowY: 'scroll'
//                 disableOn: 700,
//                 type: 'iframe',
//                     // mainClass: 'mfp-fade',
//                 removalDelay: 160,
//                 preloader: false,

//                 fixedContentPos: false
//             });
//             $(element).toolbar(scope.$eval(attrs.toolbarTip));
//         }
//     };
// });
