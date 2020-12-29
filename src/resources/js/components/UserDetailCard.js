import React from 'react';
import { Card } from 'react-bootstrap';

export default function UserDetailCard(props) {
  return (
    <Card>
      <Card.Body style={{ borderBottom: "1px solid rgba(0, 0, 0, 0.125)"}}>
        <h3>{ props.user.name }</h3>
        <div> ツイート数: { props.userDetail.count}</div>
        <div>フォロー: { props.userDetail.follows || 0}</div>
        <div>フォロワー: { props.userDetail.followers || 0}</div>
        <div>{props.user.bio}</div>
      </Card.Body>
    </Card>
  );
}