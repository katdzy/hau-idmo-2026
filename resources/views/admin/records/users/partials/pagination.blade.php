{{ $users->appends(request()->except('page'))->links() }}
