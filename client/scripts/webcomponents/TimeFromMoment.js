class TimeFromMoment {
    constructor(container) {
        var instance = this;
        instance.htmlContent = $(`
        <div class="timeOutContainer">
        
        </div>
        `);

        container.append(instance);
    }

}