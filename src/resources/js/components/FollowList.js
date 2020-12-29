import React from 'react';
import ReactDOM from 'react-dom';

function FollowList(props) {
  return(
    <>
      <h3>フォロー一覧</h3>
    </>
  );
}

export default FollowList;

if (document.getElementById('follow-list')) {
    ReactDOM.render(<FollowList />, document.getElementById('follow-list'));