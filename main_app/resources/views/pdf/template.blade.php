<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="{{ public_path('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ public_path('css/all.css') }}">

    <title>Hati</title>
    <style>
        p {
            font-size: 15px;
            font-family: "Lucida Console", Courier, monospace;
        }
    </style>
</head>

<body class="bg-white">

    <section class="bg-white">
        <div class="col-md-6 mx-auto">
            <div class="mx-auto text-center pt-5 mt-4 col-md-9">
                <strong class="h5 pb-5 mb-5"> THE UNITED REPUBLIC OF TANZANIA</strong> <br>
                <img src="{{ public_path('images/pdf/hekima.png') }}" style="width: 200px; height: 200px;"
                    class="mt-3 pt-4 pb-3" alt="hekima na umoja" srcset="">

            </div>

            <div class="pt-5 mt-3">
                <p class="floar-left"><strong>TITLE NO. 124</strong></p>
                <p><strong>This is to certify that the Ministry of Lands, Housing, and Human Settlements has entitleda
                        right to
                        occupancy to <strong style="color:red; text-transform: uppercase;">{{ $user->name }}</strong>
                        over the Land plot with
                        NUMBER of
                        <strong style="color:red">{{ $portion->id }}</strong> located at <strong
                            style="color:red; text-transform: uppercase;">{{ $land->name }}</strong>,
                        <strong style="color:red; text-transform: uppercase;">{{ $land->region }}</strong> in
                        <strong style="color:red; text-transform: uppercase;">{{ $land->district }}</strong> district
                        with a size of
                        <strong style="color:red">{{ $portion->size }}</strong> SQM as described in the
                        ministry’s website for a term of 30 years from the first day of retrieval. <br> The occupier has
                        paid a
                        total amount of TZS. <strong style="color:red"> {{ $portion->price }} </strong> on <strong
                            style="color:red">{{ $date }}
                        </strong> and is subjected to abide by and obey all tax law enforcements per theland by-laws
                        established at section III article 1 of 2003.
                    </strong>
                </p>

            </div>

            <div class="text-center pt-5 mt-3">
                <img src="{{ public_path('images/pdf/stamp.png') }}" style="width: 500px; height: 200px;"
                    alt="" srcset="">
            </div>

        </div>
    </section>


</body>

</html>
