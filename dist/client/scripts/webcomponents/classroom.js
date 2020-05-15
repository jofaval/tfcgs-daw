class Classroom extends HTMLElement {
    connectedCallback() {
        var shadowRoot = $(this.shadowRoot);
        if (!this.shadowRoot) {
            this.attachShadow({
                mode: 'open'
            });
        }

        this.shadowRoot.innerHTML = `
        <link rel="stylesheet" href="./styles/bootstrap.min.css">
        <div class="card m-1 m-sm-3">
            <div class="card-body">
                <h5 class="classroom-name card-title text-center text-dark">${this.getAttribute("classroom-name")}</h5>
                <p class="classroom-description card-text text-dark">${this.getAttribute("classroom-description")}</p>
                <a href="index.php?ctl=calendar&classroom=${this.getAttribute("classroom-name")}" class="classroom-href btn btn-primary w-100">Go to calendar</a>
            </div>
        </div>
        `;
        var eventActions = shadowRoot.find(".card-icon");
        var close = eventActions.eq(0);
        var eventScope = this;
        close.on("click", function () {
            eventScope.remove();
        });

    }

    attributeChangedCallback(name, oldValue, newValue) {
        if (this.shadowRoot == null) {
            return;
        }
        switch (name) {
            case "classroom-name":
                $(this.shadowRoot).find(".classroom-name").text(newValue);
                $(this.shadowRoot).find(".classroom-href").href("index.php?ctl=calendar&classroom=" + newValue);
                break;
            case "classroom-description":
                $(this.shadowRoot).find(".classroom-description").text(newValue);
                break;
        }
    }

    static get observedAttributes() {
        return ["classroom-name", "classroom-description"];
    }
}

customElements.define("classroom-card", Classroom);