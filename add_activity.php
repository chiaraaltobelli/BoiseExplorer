<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="activities.js"></script>

<?php
require_once __DIR__ . '/Dao.php';
$dao = new Dao();
$activityTypes = $dao->getActivityTypes();
$seasons = $dao->getSeasons();
$cities = $dao->getCities();
$states = $dao->getStates();

//Display any error messages
if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])): ?>
    <div class="error-messages" role="alert">
        <?php foreach ($_SESSION['messages'] as $message): ?>
            <p class="loginerror"><?= htmlspecialchars($message); ?></p>
        <?php endforeach; ?>
    </div>
    <?php
        unset($_SESSION['messages']); // Clear messages after displaying
    endif;

?>

<div id="addActivity" class="popup">
    <div class="closeBtn">&times;</div>
    <form action="add_activity_handler.php" method="POST" class="form">
        <h2>Add Activity</h2>

        <!-- Activity Name -->
        <div class="form-element">
            <label for="activityName">Activity Name<span class="required">*</span></label>
            <input type="text" id="activityName" name="activityName" placeholder="Activity Name" required value="<?= htmlspecialchars($_SESSION['inputs']['activityName'] ?? '') ?>">
        </div>

        <!-- Activity Type -->
        <div class="form-element">
            <label for="activityType">Activity Type<span class="required">*</span></label>
            <select id="activityType" name="activityType" required>
            <?php foreach ($activityTypes as $type): ?>
                <option value="<?= htmlspecialchars($type['ActivityType']) ?>" <?= (isset($_SESSION['inputs']['activityType']) && $_SESSION['inputs']['activityType'] == $type['ActivityType']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['ActivityType']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        </div>

        <!-- Time Of Day -->
        <div >
        <fieldset class="form-element">
            <legend>Time of Day<span class="required">*</span></legend>
            <label for="morning">Morning<input type="checkbox" id="morning" name="morning" class="time-of-day-checkbox" <?= $_SESSION['inputs']['morning'] ?? '' ?>></label>
            <label for="afternoon">Afternoon<input type="checkbox" id="afternoon" name="afternoon" class="time-of-day-checkbox" <?= $_SESSION['inputs']['afternoon'] ?? '' ?>></label>
            <label for="evening">Evening<input type="checkbox" id="evening" name="evening" class="time-of-day-checkbox" <?= $_SESSION['inputs']['evening'] ?? '' ?>></label>
        </fieldset>
                </div>

        <!-- Season -->
        <div class="form-element">
            <label for="season">Season<span class="required">*</span></label>
            <select id="season" name="season" required>
                <?php foreach ($seasons as $type): ?>
                    <option value="<?= htmlspecialchars($type['Season']) ?>" <?= (isset($_SESSION['inputs']['Season']) && $_SESSION['inputs']['Season'] == $type['Season']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($type['Season']) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Address -->
        <div class="form-element">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Address" required value="<?= htmlspecialchars($_SESSION['inputs']['address'] ?? '') ?>">
        </div>

        <!-- City -->
        <div class="form-element">
            <label for="city">City<span class="required">*</span></label>
            <select id="city" name="city" required>
                <?php foreach ($cities as $type): ?>
                    <option value="<?= htmlspecialchars($type['City']) ?>"><?= htmlspecialchars($type['City']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- State -->
        <div class="form-element">
            <label for="state">State<span class="required">*</span></label>
            <select id="state" name="state" required>
                <?php foreach ($states as $type): ?>
                    <option value="<?= htmlspecialchars($type['State']) ?>"><?= htmlspecialchars($type['State']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Zip -->
        <div class="form-element">
            <label for="zip">Zip</label>
            <input type="number" id="zip" name="zip" placeholder="Zip" required value="<?= htmlspecialchars($_SESSION['inputs']['zip'] ?? '') ?>">
        </div>

        <div class="form-element">
            <button type="submit">Add Activity</button>
        </div>
    </form>
</div>
