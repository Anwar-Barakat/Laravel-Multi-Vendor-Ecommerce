$(function () {
    $("#smartwizard").smartWizard({
        options: {
            theme: "arrows",
        },
        transition: {
            animation: "myAnimation",
        },
    });
    $.fn.smartWizard.transitions.myAnimation = (
        elmToShow,
        elmToHide,
        stepDirection,
        wizardObj,
        callback
    ) => {
        if (!$.isFunction(elmToShow.fadeOut)) {
            callback(false);
            return;
        }

        if (elmToHide) {
            elmToHide.fadeOut(
                wizardObj.options.transition.speed,
                wizardObj.options.transition.easing,
                () => {
                    elmToShow.fadeIn(
                        wizardObj.options.transition.speed,
                        wizardObj.options.transition.easing,
                        () => {
                            callback();
                        }
                    );
                }
            );
        } else {
            elmToShow.fadeIn(
                wizardObj.options.transition.speed,
                wizardObj.options.transition.easing,
                () => {
                    callback();
                }
            );
        }
    };
});
