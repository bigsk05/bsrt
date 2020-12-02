import os,time,math
#-------------------------------------#
class Calendar(object):
    def calcMeanObliquityOfEcliptic(self,t):
        seconds = 21.448 - t*(46.8150 + t*(0.00059 - t*(0.001813)))
        e0 = 23.0 + (26.0 + (seconds/60.0))/60.0
        return e0
    def calcObliquityCorrection(self,t):
        e0 = self.calcMeanObliquityOfEcliptic(t)
        omega = 125.04 - 1934.136 * t
        e = e0 + 0.00256 * math.cos(math.radians(omega))
        return e
    def calcSunApparentLong(self,t):
        o = self.calcSuntrueLong(t)
        omega = 125.04 - 1934.136 * t
        Lambda = o - 0.00569 - 0.00478 * math.sin(math.radians(omega))
        return Lambda
    def calcSuntrueLong(self,t):
        l0 = self.calcGeomMeanLongSun(t)
        c = self.calcSunEqOfCenter(t)
        O = l0 + c
        return O
    def calcGeomMeanLongSun(self,t):
        L0 = 280.46646 + t * (36000.76983 + t*(0.0003032))
        while(L0 > 360.0):
            L0 -= 360.0
        while(L0 < 0.0):
            L0 += 360.0
        return L0
    def calcSunEqOfCenter(self,t):
        m = self.calcGeomMeanAnomalySun(t)
        mrad = math.radians(m)
        sinm = math.sin(mrad)
        sin2m = math.sin(mrad+mrad)
        sin3m = math.sin(mrad+mrad+mrad)
        C = sinm * (1.914602 - t * (0.004817 + 0.000014 * t)) + sin2m * (0.019993 - 0.000101 * t) + sin3m * 0.000289
        return C
    def calcGeomMeanAnomalySun(self,t):
        M = 357.52911 + t * (35999.05029 - 0.0001537 * t)
        return M
    def calcSunDeclination(self,t):
        e = self.calcObliquityCorrection(t)
        Lambda = self.calcSunApparentLong(t)
        sint = math.sin(math.radians(e)) * math.sin(math.radians(Lambda))
        theta = math.degrees(math.asin(sint))
        return theta
c=Calendar()