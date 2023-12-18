@extends('layouts.app')

@section('customCss')
<link rel="stylesheet" href="{{ asset('app.css') }}">
@endsection

@section('content')

 
<div class="card text-center">
    <div class="card-header bg-dark text-white">
       <h2>All Users</h2> 
    </div> 
    <div class="card-body user-table">
    {{-- <table class="table table-light table-striped border border-secondary">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th> 
                <th>Action</th> 
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="user-row" data-name="{{ $user->name }}" data-bio="{{ $user->profile->bio ?? 'N/A' }}">
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td> 
                <td><a href="{{ route('user.profile', ['userId' => $user->id]) }}" class="btn btn-success">View Profile</a></td>
            </tr>
            @endforeach
        </tbody>
    </table> --}}

    <div id="user-list"> 
    </div>

    <button id="prev-page-button" class="pager btn btn-warning" style="display: none" onclick="pager(this);">Previos</button>
    <button id="next-page-button" class="pager btn btn-success" onclick="pager(this);">Next</button>

    </div>
</div>
<br>

    <div class="profile-action">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to Home</a>
    </div>

@endsection

@section('script')
        <script>

        let nextPage = 1; // Initialize page number
        let isEndOfLastPage = false; 

        const userList = document.getElementById('user-list');
        const prev =  document.getElementById('prev-page-button');
        const next =  document.getElementById('next-page-button');
        

            async function pager(el) {
                const id = el.id;   

                    try {
                        const response = await fetch(`/api/users?page=${nextPage}`);
                        if (!response.ok) {
                            throw new Error('Network response was not ok.');
                        }
                        const data = await response.json();
 
                        if (data.data.length === 0){
                            isEndOfLastPage = true;
                            data.data = [{'name':'<h2>GoodBye! End of the List :)</h2>'}]; 
                            next.style.display = 'none';
                            prev.style.display = 'inline';
                            nextPage = nextPage-1;
                           
                        }
                        else if(nextPage >1){ next.style.display = 'inline';
                        prev.style.display = 'inline';}
                        else{}

                        // Clear previous user data before appending new data
                        userList.innerHTML = '';
 
                        // Render user data on the page
                        data.data.forEach(user => {
                            userList.innerHTML += `<p class='border-bottom-0'>${user.name}</p>`; 
                        });
 
                       
                        if(id == 'next-page-button'){ 
                                if (!isEndOfLastPage) {
                                    nextPage++;
                                } 
                        }

                        if(id == 'prev-page-button'){  
                          nextPage--;  

                          if(nextPage == 0){
                                data.data = [];
                                nextPage = 1;
                                prev.style.display = 'none';
                                next.style.display = 'inline';
                                isEndOfLastPage = false;
                         }
                        } 
                     

                    } catch (error) {
                        console.error('There was a problem with the fetch operation:', error);
                    }
               

               
            }

          

        document.getElementById('next-page-button').dispatchEvent(new Event('click'));

        </script>
@endsection


 
