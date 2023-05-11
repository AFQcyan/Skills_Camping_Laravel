class Popup {
    constructor(url, width = 700, height = 700) {
        this.url = url
        this.width = width
        this.height = height
    }

    async open(data) {
        if (!this.thisWindow || this.thisWindow.closed) {
            this.thisWindow = window.open(this.url, "팝업", `width=${this.width},height=${this.height},left=100, right=150, location=no`)
            await this.waitForLoad(this.thisWindow)
            this.document = this.thisWindow.document

            this.init()
            this.addEvent()
        }
        this.thisWindow.resizeTo(this.width, this.height)

        this.document = this.thisWindow.document

        this.reset(data)
    }

    waitForLoad(window) {
        return new Promise((res, rej) => {
            window.onload = () => { res() }
            window.onerror = () => { rej() }

            setTimeout(() => {
                res()
            }, 300);
        })
    }
}
class Slide {
    constructor(itemList, btnBox, animationTime, intervalTime) {
        this.isStop = false
        this.isProcessing = false
        this.isClear = false
        this.slideType = 0

        this.itemList = itemList
        this.animationTime = animationTime
        this.intervalTime = intervalTime

        btnBox.innerHTML = ''
        this.index = 0

        for (let i = 0; i < this.itemList.length; i++) {
            const btn = document.createElement('button')
            btn.addEventListener('click', () => {
                if (this.isClear) { return }
                this.isClear = true

                clearInterval(this.interval)
                this.clearAnimation(i)

                if (!this.isStop) {
                    this.interval = setInterval(this.nextSlide.bind(this), this.intervalTime * 1000)
                }

            })
            btnBox.appendChild(btn)
        }
        this.interval = setInterval(this.nextSlide.bind(this), this.intervalTime * 1000)
    }

    animation(item, animationTime, style, value, callback) {
        $(item).animate({
            [style]: value
        }, animationTime * 1000)

        setTimeout(callback, animationTime * 1000)
    }

    clearAnimation(ele) {
        for (let i = 0; i < this.itemList.length; i++) {
            this.animation(this.itemList[i], 0, 'left', '-100%')
        }

        this.animation(this.itemList[ele], 0, 'left', '0%')
        this.animation(this.itemList[ele], 0, 'opacity', '0')
        this.animation(this.itemList[ele], this.animationTime, 'opacity', '1', () => {
            this.isClear = false
        })

        this.slideType = 1

        this.index = ele
        this.isProcessing = false
    }

    nextSlide(
        currentSlideIndex = this.index,
        nextSlideIndex = this.index + 1 < this.itemList.length ? this.index + 1 : 0
    ) {
        if (this.isProcessing) { return }
        this.isProcessing = true

        this.time = new Date()
        const currentSlide = this.itemList[currentSlideIndex]
        this.animation(currentSlide, this.animationTime, 'left', '100%', () => {
            if (!this.isStop) {
                this.animation(currentSlide, 0, 'left', '-100%')
                this.isProcessing = false
            }
        })

        this.current = currentSlideIndex

        this.index = nextSlideIndex
        this.next = nextSlideIndex

        const nextSlide = this.itemList[nextSlideIndex]
        this.animation(nextSlide, this.animationTime, 'left', '0%')
    }

    stop() {
        this.endTime = new Date()
        this.slideType = 0
        this.isStop = true
        for (let i = 0; i < this.itemList.length; i++) {
            $(this.itemList[i]).stop(true)
        }
        clearInterval(this.interval)
    }

    start() {
        this.isStop = false

        if (this.slideType == 0) {
            let leftTime = (1000 - (this.endTime - this.time)) / 1000
            this.time = new Date()

            for (let i = 0; i < this.itemList.length; i++) {
                $(this.itemList[i]).css('left', $(this.itemList[i]).css('left'))
            }
            this.animation(this.itemList[this.current], leftTime, 'left', '100%', () => {
                if (!this.isStop) {
                    this.animation(this.itemList[this.current], 0, 'left', '-100%')
                }
                this.isProcessing = false
            })

            this.animation(this.itemList[this.next], leftTime, 'left', '0%')

        }
        this.slideType = 1
        this.interval = setInterval(this.nextSlide.bind(this), this.intervalTime * 1000)

    }

}
class SlideApp {
    constructor() {
        this.init()
    }

    init() {
        const itemList = document.querySelectorAll('.slide-item')
        const btnBox = document.querySelector('.btn-box')
        const startBtn = $('.start-btn')
        const stopBtn = $('.stop-btn')

        this.slideElement = new Slide(itemList, btnBox, 1, 2)

        startBtn.click(() => {
            startBtn.css('display', 'none')
            stopBtn.css('display', 'block')
            this.slideElement.start()
        })

        stopBtn.click(() => {
            stopBtn.css('display', 'none')
            startBtn.css('display', 'block')
            this.slideElement.stop()
        })

    }

}

window.addEventListener('load', () => {
    console.log("B")
    if (window.location.href.includes('index') || window.location.href == "http://localhost/") {
        new SlideApp()
    }
})

window.addEventListener('load', () => {
    if (window.location.href.includes('reservation')) {
        new ReservationApp()
    }
})
class ReservationApp {
    constructor() {
        this.init()
    }
    async init() {
        this.reservationTableControl = new ReservationTableControl(this)
        this.reservationPopupControl = new ReservationPopupControl()
    }

    openPopup(data) {
        this.reservationPopupControl.openPopup(data);
    }
}
class ReservationTableControl {
    constructor(app) {
        this.app = app
        this.getData()

        setInterval(() => this.getData.bind(this), 4500)
    }

    async getData() {
        let jsonData;
        await $.ajax({
            type: "GET",
            url: '/reservation/show',
            dataType: 'json',
            cache: "false",
            async: true,
            success: function (res) {
                jsonData = res
            }
        });
        this.jsonData = jsonData
        console.log(this.jsonData)
        this.reset()
    }

    reset() {
        this.setData()

        const today = new Date()

        document.querySelector('table thead').innerHTML = `
            <tr>
                            <th colspan="15"><i class="fa-solid fa-house-flag W"></i> : 예약대기 | <i class="fa-solid fa-house-lock R"></i> : 예약중 | <i class="fa-solid fa-person-shelter C"></i> : 예약완료</th>
                        </tr>
                        <tr>
                            <th>자리/날짜</th>
                            <th>오늘</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                            <th>${this.setNextDate(today).myFormat('<br>')}</th>
                        </tr>
        `

        this.table = document.querySelector('table tbody');
        this.setList()
    }

    setData() {
        this.reservationData = {}

        for (let i = 1; i <= 7; i++) {
            this.reservationData[`A${padstart(i)}`] = {
                'spaceName': `A${padstart(i)}`,
                'stateList': []
            }
            for (let j = 0; j < 14; j++) {
                this.reservationData[`A${padstart(i)}`].stateList.push("W")
            }
        }
        for (let i = 1; i <= 10; i++) {
            this.reservationData[`T${padstart(i)}`] = {
                'spaceName': `T${padstart(i)}`,
                'stateList': []
            }
            for (let j = 0; j < 14; j++) {
                this.reservationData[`T${padstart(i)}`].stateList.push("W")
            }
        }
        this.jsonData.reservation.forEach((x, i) => {
            const { id, name, phone, place, date, type, create_date } = x
            const index = new Date(new Date(date).getTime() - new Date(this.jsonData.serverDate).getTime()).getDate() - 1
            console.log(new Date(new Date(date).getTime() - new Date(this.jsonData.serverDate).getTime()).getDate(), date)
            if (index < 14) {
                this.reservationData[place].stateList[index] = type == 'ongoing' ? 'R' : 'C'
            }
        })
    }
    setNextDate(date) {
        date.setDate(date.getDate() + 1)
        return date
    }
    setList() {
        this.table.innerHTML = ''
        const keyList = Object.keys(this.reservationData);
        keyList.forEach((x) => {
            const tr = this.createTr(this.reservationData[x]);
            this.table.appendChild(tr)
        })
    }
    createTr({ spaceName, stateList }) {
        const tr = document.createElement('tr')
        tr.innerHTML = `<td>${spaceName}</td>`
        stateList.forEach((x, i) => {
            tr.appendChild(this.createTd(spaceName, i, x))
        })
        return tr
    }
    createTd(spaceName, index, state) {
        const td = document.createElement('td')
        td.innerHTML = `<span class='${state}'>${this.charToIcon(state)}</span>`
        td.querySelector('span').addEventListener('click', () => {
            this.app.openPopup({ spaceName, index, state })
        })
        return td
    }
    charToIcon(state) {
        return (state == 'C' ? `<i class="fa-solid fa-person-shelter C"></i>` : (state == "W" ? `<i class="fa-solid fa-house-flag W"></i>` : `<i class="fa-solid fa-house-lock R"></i>`))
    }
}
class ReservationPopup extends Popup {
    constructor(app) {
        super('../resources/popup/reservationPopup.html', 550, 800)
        this.app = app
    }

    reset({ spaceName, index, state }) {
        this.isCodeRequest = false
        this.spaceName = spaceName
        this.state = state

        this.date = new Date()
        this.date.setDate(this.date.getDate() + index)

        const day = this.date.getDay()
        if (day === 6 || day === 0) {
            this.price = this.spaceName.includes('T') ? 20000 : 30000
        } else {
            this.price = this.spaceName.includes('T') ? 15000 : 25000
        }
        this.code.disabled = true

        this.document.querySelector('#space-name').innerHTML = `영역이름: ${this.spaceName}`
        this.document.querySelector('#price').innerHTML = `이용요금 : ${this.price} 원`
        this.document.querySelector('#date').innerHTML = `예약일: ${this.date.myFormat(".")}`
    }

    init() {
        this.phone = this.document.querySelector('input[name="phone"]');
        this.name = this.document.querySelector('input[name="name"]');
        this.code = this.document.querySelector('input[name="code"]');
        this.codeRequestBtn = this.document.querySelector('#code-request-btn');
        this.reservationBtn = this.document.querySelector('#reservation-btn')
        console.log(this.phone)

    }

    addEvent() {
        this.phone.addEventListener('input', (e) => {
            if (this.phone.value == "000-0000-0000") {
                this.thisWindow.alert("사용할수 없는 휴대폰 번호입니다.");
                this.phone.value = "";
                return;
            }
            if (/[^0-9]/.test(e.data) && e.data !== null) {
                this.thisWindow.alert('휴대폰번호를 확인해주세요')
            }
            this.phone.value = phoneFormat(this.phone.value)
        })

        this.codeRequestBtn.addEventListener('click', () => {
            this.thisWindow.alert('인증번호 요청이 완료되었습니다.')
            this.isCodeRequest = true
            this.code.disabled = false
        })

        console.log(this.code)
        this.code.onfocus = (e) => {
            if (!this.isCodeRequest) {
                this.thisWindow.alert('먼저 인증번호를 받으세요')
                return
            }
        }
        this.code.addEventListener('input', (e) => {
            if (/[^0-9]/.test(e.data) && e.data !== null) {
                this.thisWindow.alert('인증번호는 4자리 숫자만 입력가능합니다.')
                this.code.value = removeNotNumber(this.code.value)
                return
            }
            if (this.code.value.length > 4) {
                this.thisWindow.alert('인증번호는 4자리 숫자만 입력가능합니다.')
                this.code.value = this.code.value.substring(0, 4)
                return
            }
        })

        this.reservationBtn.addEventListener('click', async () => {
            const phone = this.phone.value
            const name = this.name.value
            const code = this.code.value

            if (removeNotNumber(phone).length != 11) {
                this.thisWindow.alert('휴대폰번호를 확인해주세요')
                return
            }

            if (!name) {
                this.thisWindow.alert('이름을 입력하지 않았습니다.');
                return
            }

            if (code == "" || code.length != 4) {
                this.thisWindow.alert("인증번호를 확인해주세요.")
                return
            }
            if (code != '1234') {
                this.thisWindow.alert('인증번호가 일치하지 않습니다');
                return
            }

            const response = await fetch("/reservation", {
                method: "POST",
                headers: {
                    "Content-type": "application/json"
                },
                body: JSON.stringify({
                    phone: phone,
                    name: name,
                    date: this.date.myFormat("."),
                    place: this.spaceName
                })
            })

            let str = await response.text()

            if (str != "") {
                this.thisWindow.alert(str)
                return
            }

            let myModal = new bootstrap.Modal(this.document.getElementById('myModal'), {})
            myModal.toggle()
            setTimeout(() => {
                myModal.dispose()
                this.thisWindow.close()
                window.location.href = "./mypage.php";
            }, 3000);

        })
    }
}
class ReservationPopupControl {
    constructor() {
        this.popup = new ReservationPopup()
    }
    openPopup(data) {
        const { state } = data
        if (state !== 'W') {

            let myModal = new bootstrap.Modal(document.getElementById('resv-block'), {})
            myModal.toggle()
            setTimeout(() => {
                myModal.dispose()
                window.location.reload()
            }, 3000);
            return
        }

        if (!this.popup) {
            this.popup = new ReservationPopup(this)
        }

        this.popup.open(data)
    }
}
class MyPageApp {
    constructor() {
        this.init()
    }

    init() {
        this.myPageBBQPopup = new MyPageBBQPopup(this)
        this.myPageDetailPopup = new MyPageDetailPopup(this)

        this.reservationList = document.querySelectorAll('.reservation-row')
        this.reservationList = Array.from(this.reservationList).map((x, i) => {
            const reservation = {}
            reservation.tr = x

            reservation.id = x.dataset.id

            reservation.bbqOrderBtn = x.querySelector('.bbq-order-btn')
            reservation.orderDetailBtn = x.querySelector('.order-detail-btn')
            reservation.orderCount = x.querySelector('.order-count')
            reservation.reservationCancelBtn = x.querySelector('.reservation-cancel-btn')

            reservation.bbqOrderBtn.addEventListener('click', () => {
                this.myPageBBQPopup.open({ index: reservation.id })
            })
            reservation.orderDetailBtn.addEventListener('click', () => {
                this.myPageDetailPopup.open({ index: reservation.id })
            })
            reservation.reservationCancelBtn.addEventListener('click', () => {
                window.location.href = `./process_reservation_cancel.php?id=${reservation.id}`
            })

            return reservation
        })

        console.log(this.reservationList)
    }
    saveOrder(index, orderList, tool) {
        this.myPageDetailPopup.saveData(index, orderList, tool, this.reservationList[index].orderCount)
    }
}

window.addEventListener('load', () => {
    if (window.location.href.includes('mypage')) {
        new MyPageApp()
    }
})
class MyPageBBQPopup extends Popup {
    constructor(app) {
        super('./mypageBBQPopup.html', 700, 750)
        this.app = app
    }

    reset({ index }) {
        this.index = index

        this.orderList = []
        for (let i = 0; i < 5; i++) {
            this.orderList.push(0)
        }

        this.number.value = 0

        this.checkbox.checked = false
        this.setOrderList()
    }

    init() {
        this.number = this.document.querySelector('input[type="number"]')
        this.number.value = 0
        this.input = this.document.querySelector('select');
        this.addBtn = this.document.querySelector('.add-btn');
        this.checkbox = this.document.querySelector('#borrow');
        this.orderBtn = this.document.querySelector('#order-btn');
    }

    addEvent() {
        this.number.addEventListener('input', (e) => {
            this.number.value = parseInt(removeNotNumber(this.number.value))

            if (!this.number.value || this.number.value === 'NaN') {
                this.number.value = '0'
            }
        })
        this.addBtn.addEventListener('click', (e) => {
            const count = this.number.value

            this.orderList[this.input.selectedIndex] += parseInt(count)
            console.log('debug:', this.orderList)
            this.setOrderList()
            this.number.value = '0'
        })
        this.checkbox.addEventListener('change', () => {
            const str = this.checkbox.checked ? 10000 : 0
            const borrowRow = this.document.querySelector('.borrow-row span')
            borrowRow.innerHTML = str.toLocaleString()
            this.setPrice()
        })
        this.orderBtn.addEventListener('click', this.saveOrder.bind(this))
    }

    async saveOrder() {
        if (this.isProcessing) {
            this.thisWindow.alert('이미 실행 중인 명령이 있습니다.')
            return
        }
        this.isProcessing = true

        const response = await fetch('./process_add_order.php', {
            method: 'POST',
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            body: JSON.stringify({
                reservationId: this.index,
                orderList: [
                    this.orderList[0],
                    this.orderList[1],
                    this.orderList[2],
                    this.orderList[3],
                    this.orderList[4]
                ],
                tool: this.checkbox.checked,
            })
        })

        window.location.reload()
        this.close()
        this.isProcessing = false
    }

    setOrderList() {
        this.document.querySelector('#list tbody').innerHTML = ''
        const elementRow = ['돼지고기 바비큐 세트', '해산물 바비큐 세트', '음료', '주류', '과자 세트']
        const priceRow = [12000, 15000, 3000, 5000, 4000]

        for (let i = 0; i < 5; i++) {
            if (this.orderList[i] > 0) {
                const tr = this.document.createElement('tr')
                tr.classList.add('order-row')
                tr.innerHTML = `<th>${elementRow[i]}</th>
                <td><span>0</span>인분</td>
                <td>0원</td>`
                this.document.querySelector('#list tbody').appendChild(tr)
                this.setOrderRowPrice(tr, i, priceRow[i])
            }
        }

        this.setPrice()
    }

    setOrderRowPrice(row, i, price) {
        const tdList = row.querySelectorAll('td')
        row.querySelector('span').innerHTML = this.orderList[i]
        tdList[1].innerHTML = (this.orderList[i] * price).toLocaleString() + '원'
    }

    setPrice() {
        let price = 0;
        price += this.orderList[0] * 12000
        price += this.orderList[1] * 15000
        price += this.orderList[2] * 3000
        price += this.orderList[3] * 5000
        price += this.orderList[4] * 4000

        if (this.checkbox.checked) {
            price += 10000
        }

        this.document.querySelector('#price').innerHTML = price.toLocaleString(undefined);
    }

    close() {
        this.thisWindow.close()
    }
}



class MyPageDetailPopup extends Popup {
    constructor() {
        super('./mypageDetailPopup.html', 1200, 600)
        this.orderList = {}
    }

    async reset({ index }) {
        const reservationId = index
        this.reservationId = reservationId
        await this.getData(reservationId)

        this.thisOrderList = this.orderList[reservationId]

        if (!this.thisOrderList) {
            this.thisWindow.alert('해당 예약의 주문내역이 하나도 없습니다.')
            this.thisWindow.close()
            return;
        }

        this.document.querySelector('tbody').innerHTML = ''
        let sumPrice = 0;


        for (let i = this.thisOrderList.length - 1; i >= 0; i--) {
            const item = this.thisOrderList[i]

            const tr = document.createElement('tr')

            console.log(item.state)
            tr.innerHTML = `
                <tr>
                    <td>${item.tool ? '대여함' : '대여안함'}</td>
                    <td>
                    돼지고기 바비큐 세트 <i class='fa-solid fa-chevron-right'></i><br>
                    해산물 바비큐 세트 <i class='fa-solid fa-chevron-right'></i><br>
                    음료 <i class='fa-solid fa-chevron-right'></i><br>
                    주류 <i class='fa-solid fa-chevron-right'></i><br>
                    과자 세트 <i class='fa-solid fa-chevron-right'></i><br>
                    바비큐 장비 대여<i class='fa-solid fa-chevron-right'></i>
                    </td>
                    <td>
                    ${item.orderList[0]}<br>
                    ${item.orderList[1]}<br>
                    ${item.orderList[2]}<br>
                    ${item.orderList[3]}<br>
                    ${item.orderList[4]}<br>
                    ${item.tool ? "대여함" : "대여 안함"}<br>
                    </td>
                    <td>
                    ${(item.orderList[0] * 12000).toLocaleString()}원<br>
                ${(item.orderList[1] * 15000).toLocaleString()}원<br>
                ${(item.orderList[2] * 3000).toLocaleString()}원<br>
                ${(item.orderList[3] * 5000).toLocaleString()}원<br>
                ${(item.orderList[4] * 4000).toLocaleString()}원<br> 
                ${(item.tool ? 10000 : 0).toLocaleString()}원
</td>
                    <td>${((item.orderList[0] * 12000) +
                    (item.orderList[1] * 15000) +
                    (item.orderList[2] * 3000) +
                    (item.orderList[3] * 5000) +
                    (item.orderList[4] * 4000) + (item.tool ? 10000 : 0)).toLocaleString()
                } 원</td>
                    <td>${item.state}</td>
                    <td><button class="title-btn" data-id="${item.id}">주문취소</button></td>
                </tr>
            `
            tr.querySelector('button').addEventListener('click', this.orderCancel.bind(this))

            this.table.appendChild(tr)

            let price = item.orderList[0] * 12000
            price += item.orderList[1] * 15000
            price += item.orderList[2] * 3000
            price += item.orderList[3] * 5000
            price += item.orderList[4] * 4000
            price += item.tool ? 10000 : 0

            if (item.state != "취소") {
                sumPrice += price
            }
        }

        this.document.querySelector('#price').innerHTML = sumPrice.toLocaleString()
    }

    async orderCancel(e) {
        const response = await fetch(`./process_order_cancel.php?id=${e.target.dataset.id}`)
        // this.thisWindow.alert('주문취소 되었습니다.')
        this.thisWindow.close()
        window.location.reload()
        this.reset({ index: this.reservationId })
    }

    init() {
        this.table = this.document.querySelector('tbody');
    }

    addEvent() { }

    async saveData(reservationId, orderList, tool, orderCountDom) {
        await this.getData(reservationId)

        if (this.orderList[`${index}`]) {
            this.orderList[`${index}`].push({ orderList, tool })
        } else {
            this.orderList[`${index}`] = [{ orderList, tool }]
        }

        orderCountDom.innerHTML = this.orderList[`${index}`].length

    }

    async getData(reservationId) {
        const data = (await $.getJSON('./get_order_data.php'))
        this.orderList = {}
        data.forEach((x) => {
            if (this.orderList[`${x.reservation_id}`]) {
                this.orderList[`${x.reservation_id}`].push({ ...JSON.parse(x.json_data), id: x.id, state: (x.type) === 'accept' ? '접수' : (x.type === 'complete' ? '배달완료' : '취소') })
            } else {
                this.orderList[`${x.reservation_id}`] = [{ ...JSON.parse(x.json_data), id: x.id, state: (x.type) === 'accept' ? '접수' : (x.type === 'complete' ? '배달완료' : '취소') }]
            }
        })
    }
}
class ManagementDetailPopup extends Popup {
    constructor(refreshFunc) {
        super('./menagementPopupDetail.html', 1050, 650)
        this.orderList = {}
        this.refreshFunc = refreshFunc
    }

    reset({ index }) {
        this.index = index
        this.thisOrderList = this.orderList[index]
        console.log('debug: thisorderList', this.thisOrderList)

        if (!this.thisOrderList) {
            this.thisWindow.alert('해당 예약의 주문내역이 하나도 없습니다.')
            this.thisWindow.close()
            return;
        }

        this.document.querySelector('tbody').innerHTML = ''
        let sumPrice = 0;

        for (let i = 0; i < this.thisOrderList.length; i++) {
            const item = this.thisOrderList[i]
            console.log(item)

            const tr = document.createElement('tr')

            tr.innerHTML = `
                <tr>
                    <td>${item.data.tool ? '대여함' : '대여안함'}</td>
                    <td>

                        돼지고기 바비큐 세트 <i class="fa-solid fa-chevron-right"></i> <br>
                        해산물 바비큐 세트 <i class="fa-solid fa-chevron-right"></i> <br>
                        음료 <i class="fa-solid fa-chevron-right"></i><br>
                        주류 <i class="fa-solid fa-chevron-right"></i> <br>
                        과자 세트 <i class="fa-solid fa-chevron-right"></i><br>
                        바비큐 도구대여 여부 <i class="fa-solid fa-chevron-right"></i> 
                    </td>
                    <td>
                        ${item.data.orderList[0]}개 <br>
                        ${item.data.orderList[1]}개 <br>
                        ${item.data.orderList[2]}개 <br>
                        ${item.data.orderList[3]}개 <br>
                        ${item.data.orderList[4]}개 <br>
                        ${item.tool ? "대여함" : "대여 안함"}
                    </td>
                    <td>
                        ${(item.data.orderList[0] * 12000).toLocaleString()} 원<br>
                        ${(item.data.orderList[1] * 15000).toLocaleString()} 원 <br>
                        ${(item.data.orderList[2] * 3000).toLocaleString()} 원 <br>
                        ${(item.data.orderList[3] * 5000).toLocaleString()} 원 <br>
                        ${(item.data.orderList[4] * 4000).toLocaleString()} 원<br>
                        ${(item.tool ? 10000 : 0).toLocaleString()} 원
                    </td>
                    <td>${item.price.toLocaleString()}원</td>
                    <td>
                        ${item.type === 'accept'
                    ? '접수'
                    : item.type === 'cancel' ? '취소' : '배달완료'
                }
                    </td>
                    <td>
                        <button class="cancel" >주문취소</button>
                        <button class="complete" >배달완료</button>
                    </td>
                </tr>
            `

            tr.querySelector('.cancel').addEventListener('click', () => {
                fetch(`/process_order_manage.php?id=${item.id}&process=cancel`)
                item.type = "cancel"
                this.reset({ index })
                this.refreshFunc()
            })

            tr.querySelector('.complete').addEventListener('click', () => {
                fetch(`/process_order_manage.php?id=${item.id}&process=complete`)
                item.type = "complete"
                this.reset({ index })
                this.refreshFunc()
            })

            this.document.querySelector('tbody').appendChild(tr)

            if (item.type != "cancel") {
                sumPrice += item.price
            }
        }

        this.document.querySelector('#price').innerHTML = sumPrice.toLocaleString()
    }

    init() {
        this.table = this.document.querySelector('tbody');
    }

    addEvent() {
    }

    saveData(index, orderList, orderCountDom) {
        this.orderList[`${index}`] = orderList

        orderCountDom.innerHTML = orderList.reduce((s, order) => (order.type !== 'cancel' ? ++s : s), 0)
        console.log(this.orderList)
    }

}
function padstart(num) {
    if (num < 10) {
        num = "0" + num
    }

    return num
}
Date.prototype.myFormat = function (sep) {
    return this.getFullYear().toString() + sep + padstart(this.getMonth() + 1) + '.' + padstart(this.getDate())
}
function phoneFormat(number) {
    number = removeNotNumber(number)

    if (number.length > 7) {
        number = number.replace(/(\d{0,3})(\d{0,4})(\d{0,4})/, '$1-$2-$3')
    } else if (number.length > 3) {
        number = number.replace(/(\d{0,3})(\d{0,4})/, '$1-$2')
    } else {
        number = number.replace(/(\d{0,3})/, '$1')
    }

    number = number.substr(0, 13)
    return number
}
function removeNotNumber(number) {
    try {
        return number.replace(/[^0-9]/g, '')
    } catch (error) {
        return ''
    }
}