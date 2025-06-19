<x-app-layout>
    <div class="min-h-screen">
        <div class="container">
            <div class="success-box">
                <div class="success-card">
                    <div class="sc-icon">
                        <img src="{{ asset('images/icons/success.png') }}" alt="Success Icon">
                    </div>
                    <div class="sc-title">
                        <h1>Submission Successful!</h1>
                    </div>
                    <div class="sc-msg">
                        <h3>
                            Thank you for your submission. Your entry is currently under review.
                            Please allow some time for our team to verify the information.
                        </h3>
                        <a href="{{ route('portal.pending') }}">
                            <img src="{{ asset('images/icons/portal_nav/pending.png') }}" alt="Pending Requests">
                            <h1>View Pending Requests</h1>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
    .container {
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .success-box {
        width: 100%;
        height: 560px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .success-card {
        background-color: white;
        width: 60%;
        height: 80%;
        overflow: hidden;
        border-radius: 25px;
        display: grid;
        grid-template-rows: 40% 15% 45%;
    }

    .sc-icon,
    .sc-title,
    .sc-msg,
    .sc-button {
        width: 100%;
        height: 100%;
    }

    .sc-icon {
        display: flex;
        justify-content: center;
        align-items: end;
        margin-top: 1rem;
    }

    .sc-title {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .sc-title h1 {
        font-size: 2.5rem;
        font-weight: 900;
        color: rgb(90, 90, 90);
    }

    .sc-msg {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 0 3rem;
    }

    .sc-msg h3 {
        text-align: center;
        line-height: 1rem;
    }

    .sc-msg a {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: maroon;
        color: white;
        width: 70%;
        height: 20%;
        border-radius: 25px;
        margin: 1rem 0;
        transition: 300ms;
        border: none;
    }

    .sc-msg a h1 {
        font-weight: 700;
    }

    .sc-msg a img {
        width: 25px;
        height: 25px;
        margin: 0 1rem;
    }

    .sc-msg a:hover {
        background-color: #A84655;
    }
</style>
