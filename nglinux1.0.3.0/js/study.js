function lx(obj) {
    this.Id = obj.id;
    this.src = obj.src; 
    this.img = '';
    this.cxt = '';
    this.Time = "";
    this.Time2 = ""; 
    this.sum =500;
    this.beginIpY = []; 
    this.beginIpX = [];
    this.sd = []; 
    this.init(); 

}
lx.prototype = {
    init: function() {
        var c = document.getElementById(this.Id);
        c.setAttribute("width", window.innerWidth * 2);
        c.setAttribute("height", window.innerHeight * 2);
        var cxt = c.getContext("2d");
        this.cxt = cxt;
        this.insta();
    },
    insta: function() {
        var that = this;
        that.positionStar()

    },
    newStar: function() {
        this.cxt.clearRect(0, 0, window.innerWidth * 2, window.innerHeight * 2);

        this.cxt.strokeStyle = '#fff';
        this.cxt.lineCap = 'round';
        this.cxt.lineWidth = 4;


        for (var i = 0; i < this.beginIpY.length; i++) {
            var xw = Math.floor(Math.random() * 10 * window.innerHeight) + 500;
            var ctx = this.cxt;

            if (this.beginIpY[i] >= xw) {
                this.beginIpX.splice(i, 1);
                this.beginIpY.splice(i, 1);
                this.sd.splice(i, 1);
            } else {
                this.beginIpX[i] = this.beginIpX[i] + this.sd[i];
                this.beginIpY[i] = this.beginIpY[i] + this.sd[i];
                var gra = ctx.createRadialGradient(
                    this.beginIpX[i], this.beginIpY[i], 0, this.beginIpX[i], this.beginIpY[i], 50)
                var PI = Math.PI
                gra.addColorStop(0, '#FFFFFF')
                gra.addColorStop(1, 'rgba(0,0,0,0)')
                ctx.fillStyle = gra
                ctx.beginPath()
                ctx.arc(this.beginIpX[i], this.beginIpY[i], 2, -PI / 4, -5 * PI / 4)
                ctx.lineTo(this.beginIpX[i] - 50, this.beginIpY[i] - 50)
                ctx.closePath()
                ctx.stroke();

            }
        }
    },
    positionStar: function() {
        for (var i = 0; i < 1; i++) {
            var xw = Math.floor(Math.random() * 2000);
            var wt = Math.floor(Math.random() * 30);
            var sd = Math.floor(Math.random() * 4) + 2;
            this.beginIpX.push(xw);
            this.beginIpY.push(wt);
            this.sd.push(sd);
        }
        this.starAnimet();
    },
    starAnimet: function() {
        var that = this;
        this.Time = setInterval(function() {
            that.newStar();
        }, 1);
        this.pushStarfun();
    },
    pushStarfun: function() {
        var that = this;
        this.Time2 = setInterval(function() {
            if (that.beginIpY.length < 5) {
                var xw = Math.floor(Math.random() * 2000);
                var wt = Math.floor(Math.random() * 30);
                var sd = Math.floor(Math.random() * 4) + 2;
                that.beginIpX.push(xw);
                that.beginIpY.push(wt);
                that.sd.push(sd);
            }
        }, this.sum)
    }
}
 var aa = new lx({
        id: "myCanvas",
        src: "",
    });