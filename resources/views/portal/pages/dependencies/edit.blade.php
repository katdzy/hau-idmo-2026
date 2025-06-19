<x-app-layout>
  <div class="container min-h-screen">
    <div class="add-box">
      <!-- Left Section -->
      <div class="ab-left">
        <section class="back">
          <a href="{{ route('portal.dependencies') }}" class="back-btn">
            <div class="btn-icon">
              <img src="{{ asset('images/icons/back.png') }}" alt="">
            </div>
            <div class="btn-text">
              <h1>Back to Manage</h1>
            </div>
          </a>
        </section>
        <section class="reminder">
          @if($toedit->status != "To-review")
            <h1>Edit Dependent</h1>
          @else
            <h1>Resubmit Dependent</h1>
          @endif
          <h3>Kindly double check the information before saving.</h3>
        </section>
        <section class="logo">
          <img src="{{ asset('images/hau-logo.png') }}" alt="">
        </section>
      </div>

      <!-- Right Section -->
      <div class="ab-right">
        <section class="form-title">
          <h1>Dependent Details</h1>
        </section>
        <section class="form-body">
          <form action="{{ route('portal.dependencies.update', ['id' => $toedit->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-row">
              <span>
                First Name <span class="required-indicator">*</span>
              </span>
              <input type="text" name="fname" value="{{ $toedit->fname }}" required>
            </div>

            <div class="form-row">
              <span>Middle Name</span>
              <input type="text" name="mname" value="{{ $toedit->mname }}">
            </div>

            <div class="form-row">
              <span>
                Last Name <span class="required-indicator">*</span>
              </span>
              <input type="text" name="lname" value="{{ $toedit->lname }}" required>
            </div>

            <div class="form-row">
              <span>
                Relationship <span class="required-indicator">*</span>
              </span>
              <input type="text" name="relationship" value="{{ $toedit->relationship }}" required>
            </div>

            <div class="form-row">
              <span>
                Date of Birth <span class="required-indicator">*</span>
              </span>
              <input type="date" name="date_of_birth" value="{{ $toedit->date_of_birth }}" required max="{{ date('Y-m-d') }}">
            </div>

            <div class="w-full flex flex-col leading-tight">
              <span class="text-gray-400">
                Attachment | Birth Certificate <span class="required-indicator">*</span>
              </span>
              <div class="flex-col">
                <div class="w-full flex items-center my-2" id="attachment">
                  <img src="{{ asset('images/icons/attachment.png') }}" alt="" class="w-[20px] h-[20px]">
                  <h1 class="truncate font-semibold text-gray-600">{{ $toedit->attachment }}</h1>
                  <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-8 py-1 ml-2 rounded-lg" id="edit_att">
                    <img src="{{ asset('images/icons/upload.png') }}" alt="" class="w-[20px] h-[20px]">
                    <span>Change File</span>
                  </button>
                </div>
              </div>
              <div class="w-full flex gap-2 hide" id="attachment_edit">
                <button type="button" class="bg-gray-900 hover:bg-gray-800 text-white flex items-center px-4 py-1 ml-2 rounded-lg" id="cancel">
                  <img src="{{ asset('images/icons/cancel.png') }}" alt="" class="w-[20px] h-[20px]">
                  <span>Cancel</span>
                </button>
                <input type="file" name="attachment" id="fileinput" class="text-gray-700 truncate">
              </div>
            </div>

            <div class="form-row-submit">
              <button type="submit" class="btn-submit">Submit</button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</x-app-layout>

<style>
  .container {
    width: 100%;
    display: flex;
    justify-content: center;
    padding-top: 3rem;
  }

  .add-box {
    width: 85%;
    height: 600px;
    border-radius: 15px;
    background-color: white;
    display: grid;
    grid-template-columns: 40% 60%;
  }

  .ab-left,
  .ab-right {
    width: 100%;
    height: 100%;
  }

  .ab-left {
    display: grid;
    grid-template-rows: 10% 15% 75%;
  }

  .ab-left section {
    width: 100%;
    height: 100%;
  }

  .back {
    display: flex;
    justify-content: center;
    align-items: end;
  }

  .back-btn {
    display: grid;
    grid-template-columns: 25% 75%;
    background-color: maroon;
    color: white;
    width: 70%;
    height: 60%;
    border-radius: 25px;
    transition: 300ms;
  }

  .back-btn:hover {
    background-color: #A84655;
  }

  .btn-icon,
  .btn-text {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
  }

  .btn-text {
    padding-left: 0.7rem;
  }

  .btn-icon {
    justify-content: end;
  }

  .btn-icon img {
    width: 15px;
    height: 15px;
  }

  .reminder {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    line-height: 1.5rem;
    padding-top: 1rem;
  }

  .reminder h1 {
    font-size: 1.5rem;
    font-weight: bold;
  }

  .reminder h3 {
    font-size: 0.8rem;
  }

  .required-indicator {
    color: red;
    font-weight: bold;
  }

  .logo {
    display: flex;
    justify-content: center;
  }

  .logo img {
    width: 300px;
    height: 300px;
  }

  .ab-right {
    display: grid;
    grid-template-rows: 15% 75%;
    padding-left: 2rem;
  }

  .form-title {
    display: flex;
    align-items: end;
  }

  .form-title h1 {
    font-size: 1.7rem;
    font-weight: 900;
    color: rgba(0, 0, 0, 0.7);
  }

  .form-body form {
    display: flex;
    flex-direction: column;
  }

  .form-row {
    width: 100%;
    display: flex;
    flex-direction: column;
  }

  .ab-right input[type="text"],
  .ab-right input[type="date"] {
    width: 90%;
    border: 1px solid rgba(0, 0, 0, 0.2);
    border-radius: 10px;
  }

  .ab-right input[type="text"]:active {
    border: none;
  }

  .form-row-submit {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: end;
    padding-top: 0.7rem;
    padding-right: 3rem;
  }

  .btn-submit {
    background-color: maroon;
    color: white;
    padding: 0.6rem 3rem;
    border-radius: 15px;
    transition: 300ms;
  }

  .btn-submit:hover {
    background-color: #A84655;
  }

  a,
  button {
    transition: 300ms;
  }

  .hide {
    display: none;
  }
</style>

<script>
  let attachment = document.getElementById('attachment');
  let attachment_edit = document.getElementById('attachment_edit');
  let attachment_btn = document.getElementById('edit_att');
  let cancel_btn = document.getElementById('cancel');

  attachment_btn.addEventListener("click", () => {
    attachment_edit.classList.remove('hide');
    attachment.classList.add('hide');
    document.getElementById('fileinput').setAttribute('required', 'required');
  });

  cancel_btn.addEventListener('click', () => {
    attachment_edit.classList.add('hide');
    const fileinput = document.getElementById('fileinput');
    fileinput.value = '';
    fileinput.removeAttribute('required');
    attachment.classList.remove('hide');
  });
</script>
