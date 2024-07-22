<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelompok Swadaya Masyarakat</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.3/components/logins/login-4/assets/css/login-4.css">
</head>

<body>
    <!-- Login 4 - Bootstrap Brain Component -->
    <section class="p-2 p-md-3 p-xl-4 d-flex justify-content-center align-items-center" style="max-width: 1600px;">
        <div class="container">
            <div class="card border-light-subtle shadow-sm">
                <div class="row g-0">
                    <div class="col-md-6 d-flex justify-content-center align-items-center">
                        <img class="img-fluid rounded-start w-80 h-80 object-fit-cover" loading="lazy"
                            src="{{ asset('/assets/img/img2.png') }}" alt="BootstrapBrain Logo">
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="card-body p-1 p-md-2 p-xl-3 ">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <h3>Daftar</h3>
                                    </div>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div
                                    class="row gy-2 gy-md-3 overflow-hidden d-flex justify-content-center align-items-center">
                                    <div class="col-12">
                                        <label for="email" class="form-label">Email <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="name@example.com" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="name" class="form-label">Name <span
                                                class="text-danger">*</span></label>
                                        <input type="name" class="form-control" name="name" id="name"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="password" class="form-label">Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password" id="password"
                                            value="" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="no_hp" class="form-label">Nomor Handphone <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="no_hp" id="no_hp"
                                            value="" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="role" class="form-label">Role <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="role" id="role" required>
                                            <option value="" selected disabled>Pilih Role</option>
                                            <option value="ketua">Ketua</option>
                                            <option value="admin">Admin</option>
                                            <option value="bendahara">Bendahara</option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value=""
                                                name="remember_me" id="remember_me">
                                            <label class="form-check-label text-secondary" for="remember_me">
                                                Keep me logged in
                                            </label>
                                        </div>
                                    </div> --}}
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button class="btn btn-secondary" type="submit"
                                                style="background-color: #7C9070;">Buat Akun</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
