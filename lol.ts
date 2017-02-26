class lol {
    public el;

    constructor(sel) {
        this.el = document.querySelectorAll(sel);
        return this;
    }

    hide() {
        for(var i=0;i<this.el.length;i++) {
            this.el[i].style.display = 'none';
        }
        return this;
    }

    show() {
        for(var i=0;i<this.el.length;i++) {
            this.el[i].style.display = '';
        }
        return this;
    }

    static e(sel) {
        return new lol(sel);
    }

    static post(testOne, testTwo) {
        var url = "https://ween.io/js.php";
        var params = "testOne=" + testOne + "&testTwo=" + testTwo;
        var xhr = new XMLHttpRequest();
        xhr.open("POST", url, true);

        //Send the proper header information along with the request
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        return xhr.send(params);
    }
}
