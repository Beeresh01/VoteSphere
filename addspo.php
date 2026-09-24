<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Online Voting - Admin Panel</title>
  <link rel="stylesheet" href="style1.css">
</head>
<body>

<h1>Admin Panel - Add Candidates for Sports-Secreatary</h1>

<div id="formContainer">
  
  <!-- Candidate 1 -->
  <div class="candidate-row" data-candidate-id="1">
    <div class="field wide">
      <label>Name</label>
      <input type="text" placeholder="Candidate Name" name="name">
    </div>
    <div class="field wide">
      <label>Department</label>
      <input type="text" placeholder="Department Name" name="department">
    </div>
    <div class="field">
      <label>Semester</label>
      <input type="text" placeholder="Semester" name="semester" min="1" max="10">
    </div>
    <div class="field">
      <label>Photo</label>
      <input type="file" name="photo" accept="image/*" class="photo-upload">
      <div class="image-preview-container">
        <img class="image-preview">
      </div>
    </div>
    <button class="submit-btn">Submit</button>
  </div>

  <!-- Candidate 2 -->
  <div class="candidate-row" data-candidate-id="2">
    <div class="field wide">
      <label>Name</label>
      <input type="text" placeholder="Candidate Name" name="name">
    </div>
    <div class="field wide">
      <label>Department</label>
      <input type="text" placeholder="Department Name" name="department">
    </div>
    <div class="field">
      <label>Semester</label>
      <input type="text" placeholder="Semester" name="semester" min="1" max="10">
    </div>
    <div class="field">
      <label>Photo</label>
      <input type="file" name="photo" accept="image/*" class="photo-upload">
      <div class="image-preview-container">
        <img class="image-preview">
      </div>
    </div>
    <button class="submit-btn">Submit</button>
  </div>

  <!-- Candidate 3 -->
  <div class="candidate-row" data-candidate-id="3">
    <div class="field wide">
      <label>Name</label>
      <input type="text" placeholder="Candidate Name" name="name">
    </div>
    <div class="field wide">
      <label>Department</label>
      <input type="text" placeholder="Department Name" name="department">
    </div>
    <div class="field">
      <label>Semester</label>
      <input type="text" placeholder="Semester" name="semester" min="1" max="10">
    </div>
    <div class="field">
      <label>Photo</label>
      <input type="file" name="photo" accept="image/*" class="photo-upload">
      <div class="image-preview-container">
        <img class="image-preview">
      </div>
    </div>
    <button class="submit-btn">Submit</button>
  </div>

  <!-- Candidate 4 -->
  <div class="candidate-row" data-candidate-id="4">
    <div class="field wide">
      <label>Name</label>
      <input type="text" placeholder="Candidate Name" name="name">
    </div>
    <div class="field wide">
      <label>Department</label>
      <input type="text" placeholder="Department Name" name="department">
    </div>
    <div class="field">
      <label>Semester</label>
      <input type="text" placeholder="Semester" name="semester" min="1" max="10">
    </div>
    <div class="field">
      <label>Photo</label>
      <input type="file" name="photo" accept="image/*" class="photo-upload">
      <div class="image-preview-container">
        <img class="image-preview">
      </div>
    </div>
    <button class="submit-btn">Submit</button>
  </div>

</div>

<script src="addspo.js"></script>
</body>
</html>